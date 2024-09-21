<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>ZeroBrokage</title>
</head>

<body>
    <div>
        <div>
            {{-- ..................For Logo................... --}}
            <div style="text-align:center">
                <div style="margin-bottom: 1%">
                    <img src="{{ asset('assets/img/logofinal.webp') }}" alt=""
                        style="width: 200px; max-height:65px">
                </div>
            </div>
            <div style="line-height: 1.4";>
                <h3 style="margin: 0">FLYBIZZ SERVICES INDIA PRIVATE LIMITED</h3>
                <div>ADDRESS: G-187, G-Block,</div>
                <div>Sector-63, Noida 201301 IN</div>
                <div>9429690472, info@zerobrokage.com</div>
                <div>GSTIN: 09AAECF5972H1ZA</div>
                <div>PAN NO: AAECF5972H1ZA</div>
                <div>CIN: U7499UP2021PTC147120</div>
                <div>Uttar Pradesh State Code: 09</div>
                <h3 style="text-align: center; margin: 10px 0px;">TAX INVOICE</h3>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <div style="line-height: 1.4;width:50%" >
                    <h4 style="margin: 0">Bill To</h4>
                    <div>{{ $vendor->company_name ??'' }}</div>
                    <div class="text-wrap">{{ $vendor->address ??'' }}</div>
                    {{-- <div>MAKHMALABAD NAKA, NEAR SBI PANCHWATI</div>
                    <div>BRANCH PANCHVATI 22, Naaik</div>
                    <div>GSTIN: 27DLAPA1432C1</div> --}}
                    {{-- <div>State Code :27</div> --}}
                    <div>Yes</div>
                </div>
                <div style="line-height: 1.4;width:50% text-align:end;">
                    <div>Invoice No. : {{ $invoice->invoice_number ??'' }}</div>
                    <div>Invoice Date : {{ $invoice->created_at ??'' }}</div>
                </div>
            </div>




            <div style="margin: 1% 0%;">
                <table style="border: 2px solid black; border-collapse: collapse; width: 100%;">
                    <thead>
                        <tr style="border: 2px solid black;">
                            <th style="padding: 10px; border: 2px solid black;" scope="col">#</th>
                            <th style="padding: 10px; border: 2px solid black;" scope="col">Description</th>
                            <th style="padding: 10px; border: 2px solid black;" scope="col">HSN/SAC</th>
                            <th style="padding: 10px; border: 2px solid black;" scope="col">QTY</th>
                            <th style="padding: 10px; border: 2px solid black;" scope="col">RATE</th>
                            <th style="padding: 10px; border: 2px solid black;" scope="col">CGST</th>
                            <th style="padding: 10px; border: 2px solid black;" scope="col">SGST</th>
                            <th style="padding: 10px; border: 2px solid black;" scope="col">GST</th>
                            <th style="padding: 10px; border: 2px solid black;" scope="col">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border: 2px solid black;">
                            <th scope="row" style="padding: 10px; border: 2px solid black;">1</th>
                            <td style="padding: 10px; border: 2px solid black;">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit...</td>
                            <td style="padding: 10px; border: 2px solid black;">Otto</td>
                            <td style="padding: 10px; border: 2px solid black;">@mdo</td>
                            <td style="padding: 10px; border: 2px solid black;">Otto</td>
                            <td style="padding: 10px; border: 2px solid black;">@mdo</td>
                            <td style="padding: 10px; border: 2px solid black;">Otto</td>
                            <td style="padding: 10px; border: 2px solid black;">@mdo</td>
                            <td style="padding: 10px; border: 2px solid black;">Otto</td>
                        </tr>
                        <tr style="border: 2px solid black;">
                            <th scope="row" style="padding: 10px; border: 2px solid black;">2</th>
                            <td style="padding: 10px; border: 2px solid black;">Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit...</td>
                            <td style="padding: 10px; border: 2px solid black;">Thor</td>
                            <td style="padding: 10px; border: 2px solid black;">@fat</td>
                            <td style="padding: 10px; border: 2px solid black;">Jacob</td>
                            <td style="padding: 10px; border: 2px solid black;">Thor</td>
                            <td style="padding: 10px; border: 2px solid black;">@fat</td>
                            <td style="padding: 10px; border: 2px solid black;">Thor</td>
                            <td style="padding: 10px; border: 2px solid black;">@fat</td>
                        </tr>
                        <tr style="border: 2px solid black;">
                            <th colspan="8" style="padding: 10px; border: 2px solid black;" scope="row">Discount
                            </th>
                            <td style="padding: 10px; border: 2px solid black;">0</td>
                        </tr>
                        <tr style="border: 2px solid black;">
                            <th colspan="8" style="padding: 10px; border: 2px solid black;" scope="row">Total</th>
                            <td style="padding: 10px; border: 2px solid black;">1000</td>
                        </tr>
                        <tr style="border: 2px solid black;">
                            <th colspan="8" style="padding: 10px; border: 2px solid black;" scope="row">Payable
                                Amount</th>
                            <td style="padding: 10px; border: 2px solid black;">3000</td>
                        </tr>
                        <tr style="border: 2px solid black;">
                            <th colspan="8" style="padding: 10px; border: 2px solid black;" scope="row">Paid
                                Amount</th>
                            <td style="padding: 10px; border: 2px solid black;">5000</td>
                        </tr>
                        <tr style="border: 2px solid black;">
                            <th colspan="8" style="padding: 10px; border: 2px solid black;" scope="row">Balance
                                Amount</th>
                            <td style="padding: 10px; border: 2px solid black;">9000</td>
                        </tr>
                    </tbody>
                </table>
            </div>




            <div style="line-height: 1.3";>
                Terms And Conditions This Invoice is being offered to you, the Advertiser, subject to the following
                terms and conditions:
                <ol>
                    <li>"Company" means "Flybizz Services India Private Limited" and includes
                        goservicexperts.com
                        where the context is required.</li>
                    <li>"Advertiser" means the person, company or other entity that wishes to advertise and avail of the
                        services</li>
                    <li>The rates mentioned herein are applicable for this transaction alone. The Company will have the
                        right to change the advertising rates at any given point of time. </li>
                    <li>All advertising material (collectively "Advertisement") supplied by advertiser to the Company
                        should either be owned by or be legally authorized for use by the Advertiser. The Advertisement
                        must not be obscene, offensive or unlawful in any manner and should not contravene any
                        applicable laws, rules and/or regulations.</li>
                    <li>The Company will have the sole discretion, at all times, to reject the Advertisement and further
                        does not guarantee any particular position or place in the directory/website for the display of
                        the Advertisement.</li>
                    <li>The Company will take every reasonable precaution to publish the information, as supplied by the
                        Advertiser, in the directory. However, the Company will not be responsible in case of any errors
                        or omissions.</li>
                    <li>The Company reserves the right to make any modifications, if considered necessary or desirable
                        in an Advertisement.</li>
                    <li>Unless, the Company and the Advertiser otherwise agree in writing, the Advertisement (excluding
                        the trademarks and/or trade name of the Advertiser) used in preparation of the artworks will be
                        the exclusive Home Service of the Company. The Advertiser hereby warrants that the artwork
                        design bythe Company in any of its publications will not be reproduced or assigned for
                        reproducing as a whole or in part, without the prior written consent of the Company.</li>
                    <li>Advertising agency involved in placing the Advertisement for and on behalf of any person,
                        company or entity (Ultimate Customer) assures that it has the authority to modify and/or amend
                        an Advertisement of an Ultimate Customer, in accordance with Advertiser's instructions without
                        committing any offence or tort. The Advertiser hereby warrants and agrees that it shall
                        indemnify and hold the Company harmless to the extent of any costs, damages or other charges
                        falling upon the Company as a result of any claim and/or dispute raised by the Ultimate Customer
                        against the Company arising from or relating to publication of the Advertisement</li>
                    <li>The Advertiser hereby represents and warrants that: 1. He is the owner of products and/or
                        services that he wants advertised; and/or</li>
                    <li>He is duly authorized by the owner to use the Advertisement related copy cuts and
                        illustration(s) and any trademarks & trade name which may be specified for use in the
                        Advertisement.</li>
                    <li>The Advertiser hereby agrees to notify the Company in writing of any change in ownership or
                        authorization as aforesaid, which occurs after the execution of this invoice.</li>
                    <li>The Advertiser hereby agrees to defend at its own, indemnify and keep the Company harmless from
                        any infringement claims, losses and judgments which arise from or which are claimed to have
                        arisen from the use of such copy cuts, illustrations, marks and names and Directories, the
                        Advertisement and/or any Advertisement related material including but not limiting to any
                        third-party infringement claims together with expenses, attorney fees and court costs incurred
                        by the Company.</li>
                    <li>The Advertiser assumes sole responsibility and liability for protection of its Intellectual Home
                        Service right(s) in any writing, pictorial illustration design format, photograph or combination
                        thereof included in the Advertisement.</li>
                    <li>Each paying customer is allowed to be listed in the Vendor Section. Company reserves the right
                        to change the above without any prior notice.</li>
                    <li>Under no circumstances shall the Company or its associates be liable for any direct, inlerect,
                        incidental, special, consequential or exemplary damages, (even if the Company has been advised
                        of the possibility of such damages) resulting from or in connection with the use of by the
                        Advertiser of any of Flybizz Services India Private Limited, including but not limiting to,
                        damage(s) for loss of profits, goodwill, use, data or other intangible losses. Such limitations
                        shall also apply with respect to damages incurred by reason of other services or products
                        received through or advertised in connection with the Company, regardless of any negligence
                        arising out of any of its services.</li>
                    <li>"Company" are advertised to Your Product and Service, companies are not taking any assurance for

                        businesses and leads. It's Totally Dependent your Brand's and Your Services and Market. Without
                        prejudice to

                        the aforesaid, the Company's liability under any circumstances is limited to the amount of fees,
                        if any, paid by

                        the advertisement to the Company</li>
                    <li>No refund requests owing to cancelled or fulfilled leads would be entertained as these are
                        beyond the scope of the Site since we have no role in monitoring the deal finalization,
                        transactions or preferences of the Users 18 Dispute Resolution - For any kind of legal dispute
                        related to Company would be dealt in opbcterritory.of

                        Gautam Buddha Nagar. All the legal issues are subjected only to pertinent contemporary's laws in
                        force at

                        Gautam Buddha Nagar to the jurisdiction of courts located in Gautam Buddha Nagar district in
                        Uttar Pradesh

                        only. 19. This proforma invoice shall be governed and construed in accordance with the laws of
                        India without reference to its conflict of laws principles.</li>
                    <li>In addition to the terms and conditions set forth in the invoice, and unless repugnant to the
                        meaning or context thereof, the Advertiser hereby agrees and acknowledges that the User
                        Agreement/Terms and Conditions, as reproduced on the
                        goservicexperts.com
                        [1] website '
                        goservicexperts.com
                        [1 [1]] (T & Cs) are applicable to this proforma invoice and are deemed to be incorporated
                        herein by reference. In the event of any conflict or inconsistency between this proforma invoice
                        and the "T & Cs", the latter shall prevail.</li>
                    <li>All correspondence to the Advertiser shall be sent to the address set forth overleaf and all
                        correspondences to the Company should be addressed to us Registered Office</li>
                    <li>Jurisdictions and Arbitration - a. In case of disputes or differences arising between the
                        Parties hereof, shall be subject matter of Arbitration under the Arbitration and Conciliation
                        Act 1996 and any subsequent related amendments there to unless settled amicably between the
                        Parties hereto referred to arbitration of First Party or any person nominated by them. The
                        arbitration proceedings shall be at Gautam Buddha Nagar. b. The decision of the arbitrator on
                        the dispute shall be final and binding on both the Parties. c. Subject to the forgoing, this
                        Agreement is subject to Indian laws and the Courts at Gautam Buddha Nagar only shall have
                        exclusive jurisdiction in all matters arising out of this Agreement or any arbitration here
                        under.</li>
                    <li>Suspension/Termination of Services Company reserves the right to partially suspend the User's
                        access to certain features, panels, access points or fully termina te a User's Account at any
                        time without assigning any reason or notice to the User (Free and Paid Members) in order to
                        protect the interests of other Users of
                        Goservicexperts.com
                        and/or the interests of Company.</li>
                    Termination or suspension either fully or partially as deemed fit by Company may be on reasonable
                    grounds to suspect on receipt/of complaint/ a belief/ an investigation/ a notification from
                    lawmaking bodies or governing authorities and can be done for the following reasons. If there is any
                    breach of the provisions of this Agreement by the User(s). If the information provided by the
                    User(s) is untrue, inaccurate or is not current or complete, or if the User(s) unlawfully uses
                    another person's or business entity's name or impersonates another person or business identityin
                    anymanner. If the User's actions may cause financial loss or legal liability to other User(s), or
                    Goservicexpert.com
                    or its affiliates. * If the User(s) is engaged in misuse or fraudulent use of the Services or
                    involved in illegal / prohibited/ inappropriate communications/ activities/transactions Links:

                </ol>
            </div>


        </div>

    </div>

</body>

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/search.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:55:16 GMT -->

</html>
