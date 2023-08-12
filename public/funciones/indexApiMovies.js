/* var token = $('[name="_token"]').val();
$(".searchApiMovie").on("click",function(){
    var titulo=$("#titulo").val();
    searchApiMovie(titulo);
});

function searchApiMovie(titulo){
    $.ajax({
        url: "searchApi",
        dataType: 'json',
        type: "POST",
        data: {
            _token: token,
            titulo: titulo,
        },
        success: function(data) {
            console.log(data.data);
        }
    });
}


 */
