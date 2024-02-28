<script>
    $(document).ready(function () {
        //title
        $('title').html('Vehicle Data 3000');
        //tombol print
        $('#singleSummaryButton').remove();
        // background experian
        $(".container-fluid").css('background-image', 'none');
        $(".elite-section").css('background-image', 'none');

        //head logo
        // $('.fastlink-margin').before('<div class="col-12"><img src="' + '{{asset('images/logo/logo3.png')}}' + '" alt="logo" style="display: block; margin: 0 auto; margin-bottom: 20px;"></div>');
        // $('.fastlink-margin').before('<div class="col-12"><img src="{{ asset('images/logo/logo3.png') }}" alt="logo" style="display: block; margin: 0 auto; margin-bottom: 20px;"></div>');
        var root = window.location.origin;
        var logoUrl = root + "/images/logo/logo3.png";
        $('.fastlink-margin').before('<div class="col-12"><img src="' + logoUrl + '" alt="logo" style="display: block; margin: 0 auto; margin-bottom: 20px;"></div>');



        $('.fastlink-margin:first a').remove();

        $('#assured-section').remove();
        $('.box-title-score').html('VehicleData3000 Score');
        $('.box-title-score-md').html('VehicleData3000 Score');

        //title
        $('.main-header').html("Your VehicleData3000 History Report");

        //warna
        $('.header').css({"background-color" : "#37b6ff","font-weight" : "bold"});

        //replace all autocheck
        $('footer').append("<br/><br/><br/><br/><center><b style='margin-top : 50px;'>Copyright © Vehicle Data 3000. All rights reserved</b></center>");
        
        fx('AutoCheck','VehicleData3000');
    });

function fx(a,b){
    if(window.find){
        while(window.find(a)){
            var rng=window.getSelection().getRangeAt(0);
            rng.deleteContents();
            rng.insertNode(document.createTextNode(b));
        }
    }else if(document.body.createTextRange){
        var rng=document.body.createTextRange();
        while(rng.findText(a)){
            rng.pasteHTML(b);
        }
    }
}
</script>