<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/contact-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:56:09 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Truelysell | Template</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/feather.css">

    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
</head>

<body>
    <div class="main-wrapper">

        <div class="container border p-2 shadow-sm mt-2">
            <h4> Create Vendor</h4>
        </div>
        <div class="container mt-4 border p-5 rounded shadow">
            <form>
                <div class="row mx-auto">
                    <div class="col-2">
                       <label for="formManager" class="form-label">Manager</label>
                        <select id="formManager" class="form-select bg-light-subtle" aria-label="Default select example"
                            style="box-shadow: none">
                            <option selected>Select Option</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="formFile" class="form-label">Employee</label>
                        <select class="form-select  bg-light-subtle" aria-label="Default select example"
                            style="box-shadow: none">
                            <option selected>Select Option</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="formFileCategory" class="form-label">Category</label>
                        <select id="formFileCategory" required class="form-select  bg-light-subtle"
                            aria-label="Default select example" style="box-shadow: none">
                            <option selected disabled value="">Select Option</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                     <div class="col-md-3">
                        <label for="companyname" class="form-label">Company Name</label><span> (if same name)</span>
                        <input class="form-check-input mx-1" type="checkbox" value="" id="flexCheckChecked"
                            checked>
                        <input id="companyname" class="form-control bg-light-subtle" type="text"
                            placeholder="Company name" aria-label="default input example" required>
                        <div id="companynameError" class="errorMessage text-danger"></div>
                    </div>
                     <div class="col-md-2">
                        <label for="companyname" class="form-label">Legal Company Name</label>
                        <input id="companyname" class="form-control bg-light-subtle" type="text"
                            placeholder="Company name" aria-label="default input example" required>
                        <div id="companynameError" class="errorMessage text-danger"></div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <label for="formFile" class="form-label">State</label>
                        <select class="form-select bg-light-subtle" aria-label="Default select example"
                            style="box-shadow: none">
                            <option selected>Select State</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div class="col-4">
                        <label for="formFile" class="form-label">City</label>
                        <select class="form-select bg-light-subtle" aria-label="Default select example"
                            style="box-shadow: none">
                            <option selected>Select City</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="pinnumber" class="form-label">PIN Code</label>
                        <input id="pinnumber" class="form-control bg-light-subtle" type="text"
                            placeholder="PIN code number" maxlength="6" onkeyup="validateField(this)" aria-label="default input example" required>
                        <div id="pinnumberError" class="errorMessage text-danger"></div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label text-dark">Example textarea</label>
                        <textarea class="form-control bg-light-subtle" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-4">
                        <label for="emailAddressVender" class="form-label">Email Address</label>
                        <input class="form-control bg-light-subtle" id="emailAddressVender" type="text"
                            placeholder="Email address" aria-label="default input example"
                            onkeyup="validateField(this)">
                        <div id="emailError" class="text-danger"></div>
                    </div>

                    <div class="col-4">
                        <label for="formFile" class="form-label">Whatsapp</label><span class="mx-3">(Get
                            notification)</span>
                        <input class="form-check-input mx-2" type="checkbox" value="" id="flexCheckChecked"
                            checked>
                        <input class="form-control bg-light-subtle" id="whatsappNumVender" type="text"
                            placeholder="Whatsapp number" aria-label="default input example"
                            onkeyup="validateField(this)" maxlength="10">
                        <div id="whatsappError" class="text-danger"></div>
                    </div>
                    <div class="col-4">
                        <label for="phoneNumVender" class="form-label">Phone Number</label><span class="mx-3">(Get
                            notification)</span>
                        <input class="form-check-input mx-2" type="checkbox" value="" id="flexCheckChecked"
                            checked>
                        <input class="form-control bg-light-subtle" id="phoneNumVender" type="text"
                            placeholder="Phone number" aria-label="default input example"
                            onkeyup="validateField(this)" maxlength="10" required>
                        <div id="phoneError" class="text-danger"></div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <label for="formFile" class="form-label">Website (if available)</label>
                        <input class="form-control bg-light-subtle" type="text" placeholder="www.example.com"
                            aria-label="default input example">
                    </div>
                    <div class="col-4">
                        <label for="formFile" class="form-label">Verified or Approved By Team</label>
                        <select class="form-select bg-light-subtle" aria-label="Default select example"
                            style="box-shadow: none">
                            <option selected>Industry Leader</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div class="col-4">
                        <label for="formFile" class="form-label">Choose vehicle type</label>
                        <select class="form-select bg-light-subtle" aria-label="Default select example"
                            style="box-shadow: none">
                            <option selected>Own</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                </div>

                <div class="row mt-3">
                    <div class="col-4 mb-3">
                        <label for="formFile" class="form-label">Vender Logo</label>
                        <input class="form-control bg-light-subtle" type="file" id="formFile">
                    </div>
                    <div class="col-4">
                        <label for="formFile" class="form-label">Owner name</label>
                        <input class="form-control bg-light-subtle" type="text" placeholder="Enter owner name"
                            aria-label="default input example">
                    </div>
                    <div class="col-4 mb-3">
                        <label for="formFile" class="form-label">Vender Image</label>
                        <input class="form-control bg-light-subtle" type="file" id="formFile">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3 mb-3">
                        <label for="GSTimage" class="form-label">GST Image</label>
                        <input class="form-control bg-light-subtle" type="file" id="GSTimage">
                        <div id="gstImageError" class="text-danger"></div>
                    </div>
                    <div class="col-3">
                        <label for="gstNumber" class="form-label">GST Number</label>
                        <input class="form-control bg-light-subtle" id="gstNumber" type="text"
                            placeholder="GST number" aria-label="default input example" onkeyup="validateField(this)"
                            maxlength="15">
                        <div id="gstError" class="text-danger"></div>
                    </div>
                    <div class="col-3 mb-3">
                        <label for="PanImage" class="form-label">PAN Image</label>
                        <input class="form-control bg-light-subtle" type="file" id="PanImage">
                        <div id="PanImageError" class="text-danger"></div>
                    </div>

                    <div class="col-3">
                        <label for="panCard" class="form-label">PAN Card Number</label>
                        <input class="form-control bg-light-subtle" id="panCard" type="text"
                            placeholder="PAN Card number" aria-label="default input example"
                            onkeyup="validateField(this)" maxlength="10">
                        <div id="panError" class="text-danger"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <label for="adharvender" class="form-label">Adhar Number</label>
                        <input class="form-control bg-light-subtle" id="adharvender" onkeyup="validateField(this)"
                            type="text" placeholder="Adhar Number" aria-label="default input example"
                            maxlength="12" required>
                        <div id="adharError" class="text-danger"></div>

                    </div>

                    <div class="col-3 mb-3">
                        <label for="adharImage" class="form-label">Adhar Image</label>
                        <input class="form-control bg-light-subtle" type="file" id="adharImage">
                        <div id="adharImageError" class="text-danger"></div>
                    </div>
                    <div class="col-3 mb-3">
                        <label for="formFile" class="form-label">Visiting Card Image</label>
                        <input class="form-control bg-light-subtle" type="file" id="formFile">
                    </div>
                    <div class="col-3 mb-3">
                        <label for="formFile" class="form-label">Client signature</label>
                        <input class="form-control bg-light-subtle" type="file" id="formFile">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-5 mb-3">
                        <label for="formFile" class="form-label">Official video</label>
                        <input class="form-control bg-light-subtle" type="file" id="formFile">
                    </div>

                    <div class="col-5">
                        <label for="formFile" class="form-label">Location</label>
                        <div class="d-flex gap-4">
                            <input class="form-control bg-light-subtle" type="text" placeholder="Enter location"
                                aria-label="default input example">
                            <button type="button" class="btn btn-primary">Add</button>
                        </div>
                    </div>


                </div>
                <div class="row mt-3">
                    <div class="">

                        <button type="submit" id="submitbutton" class="btn btn-success">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>










    </div>
    <script src="{{ asset('assets/js/vendor-validation.js') }}"></script>

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/jquery-3.7.0.min.js" type="d201ebf644b4d6dc0fc8d5c5-text/javascript"></script>

    <script src="assets/js/bootstrap.bundle.min.js" type="d201ebf644b4d6dc0fc8d5c5-text/javascript"></script>

    <script src="assets/js/feather.min.js" type="d201ebf644b4d6dc0fc8d5c5-text/javascript"></script>

    <script src="assets/js/owl.carousel.min.js" type="d201ebf644b4d6dc0fc8d5c5-text/javascript"></script>

    <script src="assets/plugins/select2/js/select2.min.js" type="d201ebf644b4d6dc0fc8d5c5-text/javascript"></script>

    <script src="assets/js/script.js" type="d201ebf644b4d6dc0fc8d5c5-text/javascript"></script>
    <script src="../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="d201ebf644b4d6dc0fc8d5c5-|49" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const inputvender = document.querySelector("#phoneNumVender");
        window.intlTelInput(inputvender, {
            initialCountry: "in",
            separateDialCode: true
        });
    </script>
    <script>
        const whatsappvender = document.querySelector("#whatsappNumVender");
        window.intlTelInput(whatsappvender, {
            initialCountry: "in",
            separateDialCode: true
        });
    </script>
</body>

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/contact-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:56:09 GMT -->

</html>
