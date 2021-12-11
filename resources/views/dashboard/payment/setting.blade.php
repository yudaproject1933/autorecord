<script>
    $( document ).ready(function() {
    //title
    $('title').html('Get Auto History');
    //tombol print
    $('#singleSummaryButton').remove();
    // add tombol
    $('.fastlinkButton').append("<button onclick='window.print()'' class='btn btn-sm btn-primary'>Print Document</button>&nbsp;<button class='btn btn-sm btn-primary' onclick='copy_url()'>Copy Link</button><p id='text-copy'></p>");
    //title report
    $('.logos .col-6:first a').remove();
    $('.logos .col-6:first').append('<div class="row"><div class="col-12"><span>Vehicle History Report</span><p id="date_report"></p></div></div>');

    $('.rundate').css({"text-align": "left", "font-size": "13px", "padding-left": "0px", "font-weight": "bold"});
    $('.rundate').appendTo('#date_report');
    
    //logo kanan
    $('.rightLogo').attr('src','https://www.getautohistory.com/public/img/Ceklis.png'); 

    //tulisan header
    $('.logo-title h1').html('Your Vehicle Summary Record');
    $('.logo-title').css({"text-align": "center", "margin-bottom" : "20px"});


    //background biru
    $('.data-art-container').remove();

    //baris 1 kotak kanan
    // $('.bbp-badge img').attr({'src' : 'https://www.getautohistory.com/public/img/putih.png', 'alt': ''});
    $('.bbp-badge').remove();
    $('.bbp-header').remove();
    $('.bbp-text').remove();
    
    $('.score-outer').prependTo('.bbp-box');
    $('.score-outer').attr('class', 'col-12 score-outer');
    $('.score-outer .section-tab').remove();
    // $('.score-outer').attr('class', '');

    //YOUR VEHICLE AT A GLANCE
    // $('.at-glance').remove();
    $('<div class="row"><div class="col-md-6" id="box-left"></div><div class="col-md-6" id="box-right"></div></div>').insertAfter('.decode-row');
    $('.reportSections-outer').prependTo('#box-left');
    $('#box-left').css({"padding" : "15px"});
    $('.reportSections-outer').attr('class', 'col-12 reportSections-outer');
    $('.report-tab-row2').remove();

    $('.numOwnersTab').prependTo('#box-right');
    $('.numOwner-section').appendTo('#box-right');
    //score kiri
    
    $('.score-dial').remove();
    //score kanan
    // $('.reportSection-tab').remove();

    //logoautocheck
    // $('.state-title-brand-img img').remove();

    //link term
    // $('.sectionSummaryText a').remove();

    //link
    // $('.summary-header-section-glossary').remove();
    // $('.backTop').remove();
    // $('.glossaryTable').remove();
    // $('.termsRow').remove();

    //copyright
    // $('footer').css({"text-align": "center"});
    // $('footer b').css({"margin-top": "50px"});
    $('footer').append("<br/><br/><br/><br/><b style='margin-top : 50px;'>Copyright © Get Auto History. All rights reserved</b>");

    //replace all autocheck
    // fx('AutoCheck','GetAutoHistory')
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