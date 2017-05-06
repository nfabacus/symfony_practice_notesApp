console.log('this is an additional script!');

// notesUrl comes from showOne.html.twig
console.log('notesUrl: ', notesUrl);

$.ajax({
    url: "http://localhost:8000"+notesUrl,
    success: function(data) {
        data.notes.map(function(comment){
            $("#comments").append("<p>"+comment.username+"</p><img src='/images/" + comment.avatorUri +"'>"+
            "<p>"+comment.note+"</p><p>"+comment.date+"</p>")
        });
    }});

