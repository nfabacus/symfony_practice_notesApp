console.log('this is an additional script!');
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/food/haha/notes",
    "method": "GET",
    "headers": {
        "cache-control": "no-cache",
        "postman-token": "192fa81e-6b5c-47d6-6886-33cae6a85e09"
    }
}

function commenting(comment) {
}

$.ajax(settings).done(function (response) {
    console.log(response.notes);
    response.notes.map(function(comment){
        $('#comments').append(
        '<p>'+comment.username+'</p><img src=' + comment.avatorUri +'>'+
            '<p>'+comment.note+'</p>'
    )

});
});
