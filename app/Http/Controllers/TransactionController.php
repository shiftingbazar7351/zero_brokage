<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    public function index()
    {
        $transactions = Transaction::orderByDesc('id')->paginate(10);
        return view('backend.transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|max:255|unique:transactions,transaction_id',
        ]);
        $transactions = Transaction::create($request->all());
        $transactions->payment_status = 2;
        $transactions->created_by = auth()->user()->id;
        if ($request->hasFile('screenshot')) {
            $filename = $this->fileUploadService->uploadImage('transaction/', $request->file('screenshot'));
            $transactions->screenshot = $filename;
        }

        $transactions->save();
        return redirect()->back()->with(['success' => 'Added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id); // Find transaction by ID

        return response()->json($transaction); // Return as JSON for AJAX
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'transaction_id' => 'required|max:255|unique:transactions,transaction_id,' . $id,
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        return redirect()->back()->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        try {
            $menu = Transaction::findOrFail($id);
            $menu->delete();
            return redirect()->back()->with('success', 'Menu Deleted Successfully.');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function transactionStatus(Request $request)
    {
        $item = Transaction::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }

    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->payment_status = 1; // 1 means Approved
        $transaction->save();

        return redirect()->back()->with('status', 'Transaction approved successfully.');
    }


    public function reject(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->payment_status = 0; // 0 means Rejected
        $transaction->reason = $request->input('reason'); // Save rejection reason
        $transaction->created_by = auth()->user()->id; // Save rejection reason
        $transaction->save();
        return redirect()->back()->with('status', 'Transaction rejected successfully.');
    }
}
