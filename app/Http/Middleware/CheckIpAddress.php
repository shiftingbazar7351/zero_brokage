<?php

namespace App\Http\Middleware;

use App\Models\IpAddress;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Exception;

class CheckIpAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Fetch the real public IP address using an external service with a timeout
            $response = Http::timeout(5)->withoutVerifying()->get('https://api.ipify.org?format=json');

            if ($response->successful()) {
                $userIp = $response->json('ip');
                Log::info('Public User IP: ' . $userIp);

                if (!$this->isAllowedIp($userIp)) {
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    // session()->flash('message', 'Unauthorized IP address.');
                    // session()->flash('alert-type', 'error');
                    toastr()->success('Unauthorized IP address.');
                    return redirect('/login')->withErrors(['ip' => 'Unauthorized IP address.']);
                }
            } else {
                // Handle the scenario where the response is not successful
                Log::warning('Failed to fetch public IP. Response: ' . $response->status());
            }

        } catch (Exception $e) {
            // Handle any exception, like a network error
            Log::error('Failed to fetch public IP. Error: ' . $e->getMessage());

            // Optionally, you can handle what happens if the IP fetch fails.
            // session()->flash('error', 'Unable to verify your IP address due to network issues.');
            return redirect('/login')->withErrors(['ip' => 'Unable to verify your IP address.']);
        }

        return $next($request);
    }

    /**
     * Check if the IP address is allowed.
     */
    protected function isAllowedIp(string $ip): bool
    {
        // Log the IP to ensure you're getting the expected IP
        Log::info('User IP: ' . $ip);  // This will log the IP in Laravel's log

        $partialIp = $this->getPartialIp($ip);

        Log::info('Partial IP: ' . $partialIp);  // Log the partial IP as well

        return IpAddress::where('ip_address', 'like', $partialIp . '%')->exists();
    }


    /**
     * Get only the first two segments of the IP address.
     */
    protected function getPartialIp(string $ip): string
    {
        $ipParts = explode('.', $ip);

        // Ensure at least two segments are extracted
        if (count($ipParts) >= 2) {
            // Debugging: Display or log the partial IP
            Log::info('Extracted Partial IP: ' . $ipParts[0] . '.' . $ipParts[1]);

            return $ipParts[0] . '.' . $ipParts[1];
        }

        return '';
    }

}
