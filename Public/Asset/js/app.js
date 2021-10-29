import '../../node_modules/jquery/dist/jquery.js';

const linkContainer = document.getElementById("containerHomePage");
if (linkContainer){
    const userId = document.getElementById("userId").value;
    $(document).ready(function(){
        $.ajax({
            url: '../../api/homePageAPI.php',
            method: "GET",
            dataType : "json",
        })
            .done(function(response){
                for (let i = 0; i < response.length; i++) {
                    if (response[i].user == userId || userId == 1){
                        linkContainer.innerHTML += `
                            <div class="oneLink">
                                <div class="icon">
                                    <a href="?controller=modifyLink&id=${response[i].id}"><i class="fas fa-pen"></i></a>
                                    <a href="?controller=deleteLink&id=${response[i].id}"><i class="far fa-trash-alt"></i></a>
                                </div>
                                <img src="https://decizia.com/blog/wp-content/uploads/2017/06/default-placeholder.png" alt="default image"
                                width="250px" height="250px">
                                <a href="${response[i].href}" class="linkName" title="${response[i].title}" target="<${response[i].target}">${response[i].name}</a>
                            </div>
                        `;
                    }
                }
            })
    });
}