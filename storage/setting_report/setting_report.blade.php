<script>
    $( document ).ready(function() {
        //title
        $('title').html('Get Auto History');
        //tombol print
        $('#singleSummaryButton').remove();
        // add tombol
        $('.fastlinkButton').append("<button onclick='window.print()'' class='btn btn-sm btn-primary'>Print Document</button>&nbsp;<button class='btn btn-sm btn-primary' onclick='copy_url()'>Copy Link</button><p id='text-copy'></p>"); 
    
        $('.logos .col-6:first a').remove();
        $('.logos .col-6:first').append('<div class="row"><div class="col-12"><span>Vehicle History Report</span><p id="date_report"></p></div></div>');
        $('.rundate').css({"text-align": "left", "font-size": "13px", "padding-left": "0px", "font-weight": "bold"});
        $('.rundate').appendTo('#date_report');

        $('.rightLogo').attr("src","https://vehicledata3000.com/public/images/logo7.png");
        $('.rightLogo').css({"width" : "100px"});
    
        $('.logo-title h1').html('Vehicle Summary Record');
        $('.logo-title').css({"text-align": "center", "margin-bottom" : "20px"});
        $('.data-art-container').remove();
        // $('.at-glance-text').first().html('YOUR VEHICLE SUMMARY');
        $('.at-glance').first().remove();
    
        // $('.col .at-glance').append('<span>YOUR VEHICLE SUMMARY</span>');
        $('.owner-history-outer').appendTo('.summary-area-print');
    
        $('.section-tab').remove();
        $('.reportSection-tab').remove();
    
        $('.score-dial').remove();
    
        $('.score-details').appendTo('.bbp-box');
        $('.score-details').css({"padding" : "0px"});
        $('.bbp-badge').remove();
        $('.bbp-header').remove();
        $('.bbp-text').remove();
    
        $('.numOwnersTab').prependTo('.score-section');
        $('.numOwner-section').appendTo('.score-outer'); 
        $('.score-section').remove();
    
        $('.state-title-brand-img').remove();
        $('.section-divider-text').css({"text-align" : "center"});
        // $('.col-md-10 .summary-header-section').attr('class', 'col-md-12 summary-header-section');
    
        // $('<div class="row" id="count_owner"></div>').insertAfter('.summary-area-print');
        // $('.owner-history-outer').appendTo('.score-outer');
    
        //replace all autocheck
        // fx('AutoCheck','AutoGetSummary')
        $('footer').append("<br/><br/><br/><br/><center><b style='margin-top : 50px;'>Copyright © Auto Get Summary. All rights reserved</b></center>");
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