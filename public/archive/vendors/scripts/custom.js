
$(document).ready(function() {

    $("#uploadForm").on('submit', function(e) {

        e.preventDefault();

        $.ajax({
            xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                console.log(Math.round(percentComplete*100)+"%");
                                $(".perc").text(Math.round(percentComplete*100)+"%");
                            if((Math.round(percentComplete*100))==100) {
                                $(".resultScrap").text("download completed");
                                $('#progress').removeClass('hide');
                                // $(".perc").text("");
                            }
                            $('#progress').css({
                            width: percentComplete * 100 + '%'});
                            }
                        }, false);
                    return xhr;
                },
            url: "http://localhost/Instagram-Scrap/ShowData/startScrap/" ,
            type : "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(res){
                $(".resultScrap").html(res);
            },
            error: function(er) {
                $(".resultScrap").html(er);
            }
        })
    })
})


$(document).ready(function() {

    $("#uploadForm").on('submit', function(e) {

        e.preventDefault();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
        
               // Download progress
               xhr.addEventListener("progress", function(evt){
                   if (evt.lengthComputable) {
                       var percentComplete = evt.loaded / evt.total;
                       $('#progress-bar-fill').text(percentComplete + '%').css('width', percentComplete + '%');
                   }
               }, false);
        
               return xhr;
            },
            url: "http://localhost/Instagram-Scrap/ShowData/startScrap/" ,
            type : "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(res){
                $(".resultScrap").html(res);
            },
            error: function(er) {
                $(".resultScrap").html(er);
            }
        })
    })
})


$(document).ready(function() {

    $("#uploadPropagend").on('submit', function(e) {

        e.preventDefault();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
        
               // Download progress
               xhr.addEventListener("progress", function(evt){
                   if (evt.lengthComputable) {
                       var percentComplete = evt.loaded / evt.total;
                       $('#progress-bar-fill').text(percentComplete + '%').css('width', percentComplete + '%');
                   }
               }, false);
        
               return xhr;
            },
            url: "http://localhost/Instagram-Scrap/PropagendTag/scrapPropagends/" ,
            type : "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(res){
                $(".resultScrap").html(res);
            },
            error: function(er) {
                $(".resultScrap").html(er);
            }
        })
    })
})


