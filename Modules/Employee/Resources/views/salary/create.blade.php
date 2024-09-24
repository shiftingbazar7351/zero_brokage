@extends('backend.layouts.main')


@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="row">
                <div class="container border p-2 shadow-sm my-3">
                    <h4> Create Salary</h4>
                </div>
                <div>
                    <form action="{{ route('employee-salary.store') }}" method="POST" enctype="multipart/form-data"
                        data-parsley-validate="true">
                        @csrf
                        <div class="row">
                            <!-- Basic Salary -->
                            <div class="mb-3 col-md-4">
                                <label for="basic_salary">Basic Salary</label>
                                <input type="text" class="form-control" id="basic_salary" name="basic_salary"
                                    placeholder="Enter basic salary"
                                    value="{{ old('basic_salary') }}" required>
                                @error('basic_salary')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- House Rent Allowance -->
                            <div class="mb-3 col-md-4">
                                <label for="house_rent_allowance">House Rent Allowance</label>
                                <input type="text" class="form-control" id="house_rent_allowance"
                                    placeholder="Enter House Rent Allowance" name="house_rent_allowance"
                                    value="{{ old('house_rent_allowance') }}" required>
                                @error('house_rent_allowance')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Conveyance Allowance -->
                            <div class="mb-3 col-md-4">
                                <label for="conveyance_allowance">Conveyance Allowance</label>
                                <input type="text" class="form-control" id="conveyance_allowance"
                                    placeholder="Enter Conveyance Allowance" name="conveyance_allowance"
                                    value="{{ old('conveyance_allowance') }}" required>
                                @error('conveyance_allowance')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Other Allowance -->
                            <div class="mb-3 col-md-4">
                                <label for="other_allowance">Other Allowance</label>
                                <input type="text" class="form-control" id="other_allowance" name="other_allowance"
                                    placeholder="Enter Other Allowance"
                                    value="{{ old('other_allowance') }}" required>
                                @error('other_allowance')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Personal Pay -->
                            <div class="mb-3 col-md-4">
                                <label for="personal_pay">Personal Pay</label>
                                <input type="text" class="form-control" id="personal_pay" name="personal_pay"
                                    placeholder="Enter Personal Pay"
                                    value="{{ old('personal_pay') }}" required>
                                @error('personal_pay')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Food Allowance -->
                            <div class="mb-3 col-md-4">
                                <label for="food_allowance">Food Allowance</label>
                                <input type="text" class="form-control" id="food_allowance" name="food_allowance"
                                    placeholder="Enter Food Allowance"
                                    value="{{ old('food_allowance') }}" required>
                                @error('food_allowance')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Medical Allowance -->
                            <div class="mb-3 col-md-4">
                                <label for="medical_allowance">Medical Allowance</label>
                                <input type="text" class="form-control" id="medical_allowance" name="medical_allowance"
                                    placeholder="Enter Medical Allowance"
                                    value="{{ old('medical_allowance') }}" required>
                                @error('medical_allowance')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Telephone Allowance -->
                            <div class="mb-3 col-md-4">
                                <label for="telephone_allowance">Telephone Allowance</label>
                                <input type="text" class="form-control" id="telephone_allowance"
                                    placeholder="Enter Telephone Allowance" name="telephone_allowance"
                                    value="{{ old('telephone_allowance') }}" required>
                                @error('telephone_allowance')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Provident Fund -->
                            <div class="mb-3 col-md-4">
                                <label for="provident_fund">Provident Fund</label>
                                <input type="text" class="form-control" id="provident_fund" name="provident_fund"
                                    placeholder="Enter Provident Fund"
                                    value="{{ old('provident_fund') }}" required>
                                @error('telephone_allowance')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Voluntary Provident Fund -->
                            <div class="mb-3 col-md-4">
                                <label for="voluntary_provident_fund">Voluntary Provident Fund</label>
                                <input type="text" class="form-control" id="voluntary_provident_fund"
                                    placeholder="Enter Voluntary Provident Fund" name="voluntary_provident_fund"
                                    value="{{ old('voluntary_provident_fund') }}" required>
                                @error('voluntary_provident_fund')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Professional Tax -->
                            <div class="mb-3 col-md-4">
                                <label for="professional_tax">Professional Tax</label>
                                <input type="text" class="form-control" id="professional_tax" name="professional_tax"
                                    placeholder="Enter Professional Tax" value="{{ old('professional_tax') }}" required>
                                @error('professional_tax')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Personal Loan Principal -->
                            <div class="mb-3 col-md-4">
                                <label for="personal_loan_principal">Personal Loan Principal</label>
                                <input type="text" class="form-control" id="personal_loan_principal"
                                    placeholder="Enter Personal Loan Principal" name="personal_loan_principal"
                                    value="{{ old('personal_loan_principal') }}" required>
                                @error('personal_loan_principal')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Personal Loan Interest -->
                            <div class="mb-3 col-md-4">
                                <label for="personal_loan_interest">Personal Loan Interest</label>
                                <input type="text" class="form-control" id="personal_loan_interest"
                                    placeholder="Enter Personal Loan Interest" name="personal_loan_interest"
                                    value="{{ old('personal_loan_interest') }}" required>
                                @error('personal_loan_interest')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Food Relief -->
                            <div class="mb-3 col-md-4">
                                <label for="food_relief">Food Relief</label>
                                <input type="text" class="form-control" id="food_relief" name="food_relief"
                                    placeholder="Enter Food Relief" value="{{ old('food_relief') }}" required>
                                @error('food_relief')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
