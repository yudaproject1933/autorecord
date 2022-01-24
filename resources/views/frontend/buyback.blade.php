@extends('layouts.frontend1.main')

@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="col-md-12">
        <center>
            <img src="{{asset('images/money-back.jpg')}}" alt="" style="height: 150px;"><br>
            <h4>Buyback Protection Terms and Conditions</h4>
        </center>
    </div>
    
    <div class="col-md-12">
        <span><b>Subject to the following, Experian agrees to pay the Customer the Customer's purchase price of the Vehicle if:</b></span>
        <ol>
            <li>The AutoCheck Vehicle History Report was provided prior to the purchase of the Vehicle and on or after June 27, 2005; and</li>
            <li>The AutoCheck Vehicle History Report reflects no Branded Titles or other major issues as part of the Vehicle Title history, but a Branded Title actually exists.</li>
        </ol>
    </div>
    <div class="col-md-12">
        <span><b>DEFINITIONS</b></span>
        <ol>
            <li>Branded Title- is a vehicle ownership or registration document issued by any of the 50 states of the U.S. (or the District of Columbia), issued with words or symbols signifying that the vehicle was: junked or salvaged; dismantled, rebuilt or reconstructed; flood damaged; fire damaged; hail damaged; bought back by its manufacturer ("Lemon Law" vehicle); odometer exceeds mechanical limits; odometer was not actual mileage; or which was issued with any other symbol or word signifying a substantially similar brand.</li>
            <li>Excluded Brands- Specifically excluded from the definition of Branded Title are: ownership and registration documents originally issued without a brand but later stamped with a brand without being reissued; salvage titles issued due to theft; damage disclosure documents; and Branded Titles issued in error and later corrected. Other information that may reflect negatively on the vehicle, including but not limited to accident information, is excluded from AutoCheck Buyback Protection unless expressly covered by the definition of "Branded Title".</li>
            <li>Consumer- the person (other than a Dealer or Transferee) who ordered and paid for the Report prior to their purchase of the Vehicle.</li>
            <li>Customer- a Consumer, or any licensed automobile dealer ("Dealer") who ordered and paid for the Report through an AutoCheck Commercial Service ("Commercial Service" is any site geared solely for dealers or other commercial users, such as AutoCheckmembers.com, either accessed directly or through a partner, and AutoCheck Express) or the Transferee of any such Dealer.</li>
            <li>Transferee- the purchaser of the Vehicle from the Dealer.</li>
            <li>Vehicle- the passenger vehicle or light truck to which the Report relates.</li>
        </ol>
    </div>
    <div class="col-md-12">
        <span><b>TERMS AND CONDITIONS</b></span>
        <ol>
            <li>The Customer must have previously purchased the Vehicle and own the Vehicle at the time the claim is made. If the Vehicle is subject to a lien in an unpaid amount greater than the amount identified in item 8, this Protection only applies if the Customer pays Experian the difference.</li>
            <li>The Customer must complete and submit to Experian an executed claim form and provide a complete copy of the Report. Any Dealer Customer must have obtained the Report through an AutoCheck Commercial Service prior to the purchase of the Vehicle.</li>
            <li>The Customer must provide to Experian proof of ownership of the Vehicle in the form of the original bill of sale and a current vehicle ownership document issued to the Customer by the motor vehicle agency of one of the 50 states of the United States or the District of Columbia.</li>
            <li>The Customer must provide to Experian a copy of the front and back of the Branded Title, certified by the issuing state authority. The Branded Title must have been issued at least sixty (60) days prior to the date the Report was run.</li>
            <li>The Customer must deliver to Experian all ownership and registration documentation including, the certificate of title and certificate of registration, properly assigned by the Customer to Experian so Experian becomes the owner of the Vehicle.</li>
            <li>If, prior to purchasing the Vehicle, the Customer knew, or had evidence, of the existence of a Branded Title for the Vehicle, the Protection does not apply.</li>
            <li>Experian will pay a maximum of the purchase price of the Vehicle paid by the Customer (plus warranties and other additional purchases such as installed aftermarket accessories, not exceeding a total of $500).</li>
            <li>If the purchase price of the Vehicle in item 7 exceeds the NADA Used Car Guides used vehicle retail value at the time of the sale, Experian will pay no more than ten percent (10%) over the NADA Used Car Guides used vehicle retail value at the time the Customer purchased the Vehicle.</li>
            <li>The Buyback Protection will apply only if the Vehicle was manufactured in model year 1981 or later.</li>
            <li>The Buyback Protection will expire the earlier of (a) the date the Customer sells the Vehicle or (b) one (1) year after the date of the first Report run by or for the Customer relating to the Vehicle.</li>
            <li>This Buyback Protection is deemed assigned to the Transferee upon the sale of the Vehicle, provided that a copy of the Report is given to the Transferee and the Transferee registers in accordance with item 12.</li>
            <li>In order for this Buyback Protection to be in effect for Transferees or Consumers, they must register with Experian within ninety (90) days of the date they purchased the Vehicle. Registration may be made online at www.autocheck.com/protection or by writing Experian for a registration form and submitting the same to Experian. The registration form must be completed and submitted to: Buyback Protection C/O Experian Automotive, 955 American Lane, Schaumburg, IL 60173.</li>
        </ol>
    </div>
</div>
@endsection