import '../../node_modules/jquery/dist/jquery.js';

function deleteClick() {
    $(document).ready(() => {
        $(".delButton").click(function (e) {
            $.ajax({
                type: "POST",
                url: '../../api/homePageAPI.php',
                data: {
                    deleteId: e.target.dataset.id,
                },
                dataType: "json"
            })
                .always(function () {
                    homePage();
                });
        });
    });
}
const editContainer = document.querySelector("#containerEditLink");
function editClick() {
    $(document).ready(() => {
        $(".editButton").click(function (e) {
            editContainer.innerHTML = `
                    <div id="containerEdit">
                    <input type="hidden" name="id" value="${e.target.dataset.id}">
                        <div>
                            <label for="link">Lien: </label>
                            <input type="text" id="link" name="link" value="${e.target.parentElement.nextElementSibling.nextElementSibling.href}">
                        </div>
                        <div>
                            <label for="title">Titre: </label>
                            <input type="text" id="title" name="title" value="${e.target.parentElement.nextElementSibling.nextElementSibling.innerHTML}">
                        </div>
                        <div>
                            <label for="target">S'ouvre: </label>
                            <select name="target" id="target">
                                <option value="_blank">Dans une autre page</option>
                                <option value="_self">Sur la même page</option>
                            </select>
                        </div>
                        <div id="divEdit">modifier</div>
                    </div>
            `;
            modifyClick();
        });
    });
}

function modifyClick() {
    $(document).ready(() => {
        $("#divEdit").click(function (e) {
            const id = document.querySelector('input[name="id"]').value;
            const link = document.querySelector('input[name="link"]').value;
            const title = document.querySelector('input[name="title"]').value;
            const target = document.querySelector('select[name="target"]').value;
            $.ajax({
                type: "POST",
                url: '../../api/homePageAPI.php',
                data: {
                    editId: id,
                    editLink: link,
                    editTitle: title,
                    editTarget: target
                },
                dataType: "json"
            })
                .always(function () {
                    homePage();
                });
        });
    });
}

const addContainer = document.querySelector("#containerAddLink");
function addClick() {
    $(document).ready(() => {
        $("#addButton").click(function (e) {
            addContainer.innerHTML = `
                    <div id="containerEdit">
                        <div>
                            <label for="link">Lien: </label>
                            <input type="text" id="link" name="link">
                        </div>
                        <div>
                            <label for="title">Titre: </label>
                            <input type="text" id="title" name="title">
                        </div>
                        <div>
                            <label for="target">S'ouvre: </label>
                            <select name="target" id="target">
                                <option value="_blank">Dans une autre page</option>
                                <option value="_self">Sur la même page</option>
                            </select>
                        </div>
                        <div id="divAdd">Ajouter</div>
                    </div>
            `;
            addButtonClick();
        });
    });
}

function addButtonClick() {
    $(document).ready(() => {
        $("#divAdd").click(function () {
            const link = document.querySelector('input[name="link"]').value;
            const title = document.querySelector('input[name="title"]').value;
            const target = document.querySelector('select[name="target"]').value;
            $.ajax({
                type: "POST",
                url: '../../api/homePageAPI.php',
                data: {
                    addLink: link,
                    addTitle: title,
                    addTarget: target
                },
                dataType: "json"
            })
                .always(function () {
                    homePage();
                });
        });
    });
}

const contactContainer = document.querySelector("#containerContact");
function contactClick() {
    $(document).ready(() => {
        $("#contactButton").click(function (e) {
            contactContainer.innerHTML = `
                    <label for="topic">Sujet: </label>
                    <input type="text" id="topic" name="topic">
                    <label for="message">Votre message: </label>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                    <div id="divContact">Envoyer</div>
            `;
            contactButtonClick();
        });
    });
}

function contactButtonClick() {
    $(document).ready(() => {
        $("#divContact").click(function () {
            const topic = document.querySelector('input[name="topic"]').value;
            const message = document.querySelector('textarea[name="message"]').value;
            $.ajax({
                type: "POST",
                url: '../../api/homePageAPI.php',
                data: {
                    topic: topic,
                    message: message
                },
                dataType: "json"
            })
                .always(function () {
                    homePage();
                });
        });
    });
}

const linkContainer = document.querySelector("#containerHomePage");
function homePage(){
    if (linkContainer) {
        const userId = document.querySelector("#userId").value;
        $(document).ready(function () {
            $.ajax({
                url: '../../api/homePageAPI.php',
                method: "GET",
                dataType: "json",
            })
                .done(function (response) {
                    linkContainer.innerHTML = "";
                    editContainer.innerHTML = "";
                    addContainer.innerHTML = "";
                    contactContainer.innerHTML = "";
                    for (let i = 0; i < response.length; i++) {
                        if (response[i].user === userId || userId === "1") {
                            linkContainer.innerHTML += `
                                <div class="oneLink">
                                    <div class="icon">
                                        <i class="fas fa-pen editButton" data-id="${response[i].id}"></i>
                                        <p>${response[i].user}</p>
                                        <i class="far fa-trash-alt delButton" data-id="${response[i].id}"></i>
                                    </div>
                                    <img src="https://decizia.com/blog/wp-content/uploads/2017/06/default-placeholder.png" alt="default image"
                                    width="250px" height="250px">
                                    <a href="${response[i].href}" class="linkName" title="${response[i].title}" target="<${response[i].target}">${response[i].name}</a>
                                </div>
                            `;
                        }
                    }
                    deleteClick();
                    editClick();

                })
        });
    }
}

homePage();
contactClick();
addClick();