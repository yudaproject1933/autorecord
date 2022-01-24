<script>
    $( document ).ready(function() {
        //title
        $('title').html('Vehicle Data 3000');
        //tombol print
        $('#singleSummaryButton').remove();
        // add tombol
        $('.fastlinkButton').append("<button onclick='window.print()'' class='btn btn-sm btn-primary'>Print Document</button>&nbsp;<button class='btn btn-sm btn-primary' onclick='copy_url()'>Copy Link</button><p id='text-copy'></p>"); 
    
        // report run kiri atas
        $('.logos').before('<div class="row"><div class="col-md-12"><img src="https://vehicledata3000.com/public/images/logo7.png" alt="AutoCheck logo" style="width: 100px; float: right;"></div></div>');
        $('.logos .col-6:first a').remove();
        $('.logos .col-6:first').append('<div class="row"><div class="col-12"><span style="font-size: 20pt; font-weight: bold; color: #37b6ff;">Your VehicleData3000 History Report</span><p id="date_report"></p></div></div>');
        $('.rundate').css({"text-align": "left", "font-size": "13px", "padding-left": "0px", "font-weight": "bold"});
        $('.rundate').appendTo('#date_report');
    
        // $('.rightLogo').attr("src","https://vehicledata3000.com/public/images/logo7.png");
        // $('.rightLogo').css({"width" : "100px"});
        $('.rightLogo').remove();
    
        $('.logo-title h1').html('A Glimpse Of Your Vehicle').css({"color" : "white"});
        $('.logo-title').css({"text-align": "center", "margin-bottom" : "20px", "background-color" : "#37b6ff", "border-radius" : "25px"});
        $('.data-art-container').remove();
        $('.at-glance').first().remove();
    
        $('.owner-history-outer').appendTo('.summary-area-print');
        $('.owner-history-outer').attr("style","padding-top: 10px!important; margin-top: 0px!important;");
    
        $('.score-section').css({"height" : "220px"});
    
        $('.section-tab').remove();
        $('.reportSection-tab').remove();
    
        $('.score-dial').remove();
        // $('.score-dial').appendTo('.bbp-box');
    
        // $('.score-details').appendTo('.bbp-box');
        // $('.score-details').css({"padding" : "0px"});
        $('.bbp-badge img').attr("src", "https://vehicledata3000.com/public/images/money-back.jpg");
        $('.bbp-box').attr("style","height: 190px;");
        // $('.bbp-header').remove();
        // $('.bbp-text').remove();
    
        // $('.numOwnersTab').prependTo('.score-section');
        // $('.numOwner-section').appendTo('.score-outer'); 
        // $('.score-section').remove();
    
        $('.state-title-brand-img').remove();
        // $('.section-divider-text').css({"text-align" : "center"});
    
        $('.owner-history-outer').before('<div class="col-12 logo-title" style="text-align: center; background-color: rgb(55, 182, 255); border-radius: 25px; margin-top: 30px;"><h1 style="color: white;">Owner History</h1></div>');
        
        $('.ownersimg').prependTo('.owner-section');
        $('.numOwner-section').remove();
    
        //owner header
        $('.owner-header').attr("style", "background-color: white; color: black; font-weight: bold;")
    
        //header label
        $('.section-divider-streach').eq(0).empty();
        $('.section-divider-streach').eq(0).append('<div class="row header-major-state" style="background-color: #3eb0f7; color: white; height: 50px; border-radius: 15px; padding: 5px;"><center><div class="col-md-12" style="display: inline-flex;"><img class="icon_on_section d-none d-sm-block" src="https://www.autocheck.com/reportservice/report/fullReport/img/heading-major-state-title.svg" alt="Accident Check" style="height: 40px; margin-right: 15px;"/><span style="font-size: 30px;">Major State Title Brand Check</span></div></center></div>');
    
        $('.section-divider-streach').eq(1).empty();
        $('.section-divider-streach').eq(1).append('<div class="row header-accident-check" style="background-color: #3eb0f7; color: white; height: 50px; border-radius: 15px;"><center><div class="col-md-12" style="display: inline-flex;"><img class="icon_on_section d-none d-sm-block" src="https://www.autocheck.com/reportservice/report/fullReport/img/heading-accident-check.svg" alt="Accident Check" style="height: 45px; margin-right: 15px;"/><span style="font-size: 40px;">Accident Check</span></div></center></div>');
    
        $('.section-divider-streach').eq(2).empty();
        $('.section-divider-streach').eq(2).append('<div class="row header-demage-check" style="background-color: #3eb0f7; color: white; height: 50px; border-radius: 15px;"><center><div class="col-md-12" style="display: inline-flex;"><img class="icon_on_section d-none d-sm-block" src="https://www.autocheck.com/reportservice/report/fullReport/img/heading-damage-check.svg" alt="Accident Check" style="height: 45px; margin-right: 15px;"/><span style="font-size: 40px;">Demage Check</span></div></center></div>');
    
        $('.section-divider-streach').eq(3).empty();
        $('.section-divider-streach').eq(3).append('<div class="row header-other-title" style="background-color: #3eb0f7; color: white; height: 50px; border-radius: 15px;"><center><div class="col-md-12" style="display: inline-flex;"><img class="icon_on_section d-none d-sm-block" src="https://www.autocheck.com/reportservice/report/fullReport/img/heading-other-title-brand.svg" alt="Accident Check" style="height: 45px; margin-right: 15px;"/><span style="font-size: 30px; padding: 5px 0px;">Other Title Brand And Specific Event Check</span></div></center></div>');
    
        $('.section-divider-streach').eq(4).empty();
        $('.section-divider-streach').eq(4).append('<div class="row header-odometer" style="background-color: #3eb0f7; color: white; height: 50px; border-radius: 15px;"><center><div class="col-md-12" style="display: inline-flex;"><img class="icon_on_section d-none d-sm-block" src="https://www.autocheck.com/reportservice/report/fullReport/img/heading-other-title-brand.svg" alt="Accident Check" style="height: 45px; margin-right: 15px;"/><span style="font-size: 40px;">Odometer Check</span></div></center></div>');
    
        $('.section-divider-streach').eq(5).empty();
        $('.section-divider-streach').eq(5).append('<div class="row header-open-recall" style="background-color: #3eb0f7; color: white; height: 50px; border-radius: 15px;"><center><div class="col-md-12" style="display: inline-flex;"><img class="icon_on_section d-none d-sm-block" src="https://www.autocheck.com/reportservice/report/fullReport/img/heading-recall.svg" alt="Accident Check" style="height: 45px; margin-right: 15px;"/><span style="font-size: 40px;">Open Recall Check</span></div></center></div>');
    
    
        //
        $('.at-glance-text').eq(0).html("Summary Vehicle History ");
        $('.at-glance').eq(0).attr("style", "background-color: #3eb0f7;  border-radius: 15px;");
    
        $('.at-glance').eq(1).attr("style", "background-color: #3eb0f7;  border-radius: 15px;");
    
        $('.full-report__terms p:eq(0) a').attr('href','https://vehicledata3000.com/members/terms-do');
        $('.full-report__terms p:eq(1) a').attr('href','https://vehicledata3000.com/members/buyback');
    
        //replace all autocheck
        $('footer').append("<br/><br/><br/><br/><center><b style='margin-top : 50px;'>Copyright © Vehicle Data 3000. All rights reserved</b></center>");
    
        fx('AutoCheck','VehicleData3000');
    });
    function copy_url(){
        var $temp = $("<input>");
        var $url = $(location).attr('href');
        $("body").append($temp);
        $temp.val($url).select();
        document.execCommand("copy");
        $temp.remove();
        $("#text-copy").text("URL copied!");
    }
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