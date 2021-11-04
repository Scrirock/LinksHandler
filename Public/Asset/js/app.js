import '../../node_modules/jquery/dist/jquery.js';
import '../../node_modules/chart.js/dist/chart.js';

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
            editContainer.innerHTML = "";
            addContainer.innerHTML = "";
            contactContainer.innerHTML = "";
            editContainer.innerHTML = `
                    <div class="card">
                        <input type="hidden" name="id" value="${e.target.dataset.id}">
                        <div class="card-form">
                            <div class="input">
                                <input type="text" class="input-field" id="link" name="link" value="${e.target.parentElement.nextElementSibling.nextElementSibling.href}" required/>
                                <label class="input-label" for="link">Lien</label>
                            </div>
                            <div class="input">
                                <input type="text" class="input-field" id="title" name="title" value="${e.target.parentElement.nextElementSibling.nextElementSibling.innerHTML}" required/>
                                <label class="input-label" for="title">Titre</label>
                            </div>
                            <label id="img_category_label" class="field" for="img_category" data-value="">
                                <span>S'ouvre</span>
                                <div id="img_category" class="psuedo_select" name="img_category">
                                    <span class="selected"></span>
                                    <ul id="img_category_options" class="options">
                                        <li class="option" data-value="_blank">Dans une autre page</li>
                                        <li class="option" data-value="_self">Sur la même page</li>
                                    </ul>
                                </div>
                            </label>
                            <div class="action">
                                <button class="action-button" id="divEdit">Modifier</button>
                            </div>
                        </div>
                    </div>
            `;
            modifyClick();
            (form.f.init.register)();
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
            editContainer.innerHTML = "";
            addContainer.innerHTML = "";
            contactContainer.innerHTML = "";
            addContainer.innerHTML = `
                    <div class="card">
                        <div class="card-form">
                            <div class="input">
                                <input type="text" class="input-field" id="link" name="link" required/>
                                <label class="input-label" for="link">Lien</label>
                            </div>
                            <div class="input">
                                <input type="text" class="input-field" id="title" name="title" required/>
                                <label class="input-label" for="title">Nom</label>
                            </div>
                            <label id="img_category_label" class="field" for="img_category" data-value="">
                                <span>S'ouvre</span>
                                <div id="img_category" class="psuedo_select" name="img_category">
                                    <span class="selected"></span>
                                    <ul id="img_category_options" class="options">
                                        <li class="option" data-value="_blank">Dans une autre page</li>
                                        <li class="option" data-value="_self">Sur la même page</li>
                                    </ul>
                                </div>
                            </label>
                            <div class="action">
                                <button class="action-button" id="divAdd">Ajouter</button>
                            </div>
                        </div>
                    </div>
            `;
            addButtonClick();
            (form.f.init.register)();
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
            editContainer.innerHTML = "";
            addContainer.innerHTML = "";
            contactContainer.innerHTML = "";
            contactContainer.innerHTML = `
                    <div class="card">
                        <div class="card-form">
                            <div class="input">
                                <input type="text" class="input-field" id="topic" name="topic" required/>
                                <label class="input-label" for="topic">Sujet</label>
                            </div>
                            <div class="textarea">
                                <label for="message" class="select-label">Message</label>
                                <textarea name="message" id="message" cols="30" rows="10"></textarea>
                            </div>
                            <div class="action">
                                <button class="action-button" id="divContact">Envoyer</button>
                            </div>
                        </div>
                    </div>
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

const userId = document.querySelector("#userId").value;
const linkContainer = document.querySelector("#containerHomePage");
function homePage(){
    if (linkContainer) {
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
                        if (response[i].user === userId && userId !== "1") {
                            linkContainer.innerHTML += `
                                <div class="oneLink">
                                    <div class="icon">
                                        <i class="fas fa-pen editButton" data-id="${response[i].id}"></i>
                                        <i class="far fa-trash-alt delButton" data-id="${response[i].id}"></i>
                                    </div>
                                    <img src="${response[i].img}" alt="default image"
                                    width="250px" height="250px">
                                    <a href="${response[i].href}" data-id="${response[i].id}" class="linkName" title="${response[i].title}" target="<${response[i].target}">${response[i].name}</a>
                                </div>
                            `;

                        }
                        else if (userId === "1") {
                            linkContainer.innerHTML += `
                                <div class="oneLink">
                                    <div class="icon">
                                        <i class="fas fa-pen editButton" data-id="${response[i].id}"></i>
                                        <p class="userName">${response[i].userName}</p>
                                        <i class="far fa-trash-alt delButton" data-id="${response[i].id}"></i>
                                    </div>
                                    <img src="${response[i].img}" alt="default image"
                                    width="250px" height="250px">
                                    <a href="${response[i].href}" data-id="${response[i].id}" class="linkName" title="${response[i].title}" target="<${response[i].target}">${response[i].name}</a>
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

setTimeout(()=>{
    $(document).ready(() => {
        $(".linkName").click(function (e) {
            $.ajax({
                type: "POST",
                url: '../../api/homePageAPI.php',
                data: {
                    linkId: e.target.dataset.id,
                },
                dataType: "json"
            })
        });
    });
}, 100);

$(document).ready(function () {
    $.ajax({
        url: '../../api/homePageAPI.php',
        method: "GET",
        dataType: "json",
    })
        .done(function (response) {
            let labelArray = [];
            let dataArray = [];

            for (let i = 0; i < response.length; i++) {
                if (response[i].user === userId){
                    labelArray.push(response[i].name);
                    dataArray.push(response[i].timeClicked);
                }
            }
            let ctx = $('#myChart');
            let myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labelArray,
                    datasets: [{
                        label: '# of Clicks',
                        data: dataArray,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            display: false
                        }
                    }
                }
            });
        })
});

////////////////////////////////////
// prerequisite utility functions //
// the real stuff starts below    //
////////////////////////////////////
var util = {
        f: {
            addStyle: function (elem, prop, val, vendors) {
                var i, ii, property, value
                if (!util.f.isElem(elem)) {
                    elem = document.getElementById(elem)
                }
                if (!util.f.isArray(prop)) {
                    prop = [prop]
                    val = [val]
                }
                for (i = 0; i < prop.length; i += 1) {
                    var thisProp = String(prop[i]),
                        thisVal = String(val[i])
                    if (typeof vendors !== "undefined") {
                        if (!util.f.isArray(vendors)) {
                            vendors.toLowerCase() == "all" ? vendors = ["webkit", "moz", "ms", "o"] : vendors = [vendors]
                        }
                        for (ii = 0; ii < vendors.length; ii += 1) {
                            elem.style[vendors[i] + thisProp] = thisVal
                        }
                    }
                    thisProp = thisProp.charAt(0).toLowerCase() + thisProp.slice(1)
                    elem.style[thisProp] = thisVal
                }
            },
            cssLoaded: function (event) {
                var child = util.f.getTrg(event)
                child.setAttribute("media", "all")
            },
            events: {
                cancel: function (event) {
                    util.f.events.prevent(event)
                    util.f.events.stop(event)
                },
                prevent: function (event) {
                    event = event || window.event
                    event.preventDefault()
                },
                stop: function (event) {
                    event = event || window.event
                    event.stopPropagation()
                }
            },
            getSize: function (elem, prop) {
                return parseInt(elem.getBoundingClientRect()[prop], 10)
            },
            getTrg: function (event) {
                event = event || window.event
                if (event.srcElement) {
                    return event.srcElement
                } else {
                    return event.target
                }
            },
            isElem: function (elem) {
                return (util.f.isNode(elem) && elem.nodeType == 1)
            },
            isArray: function(v) {
                return (v.constructor === Array)
            },
            isNode: function(elem) {
                return (typeof Node === "object" ? elem instanceof Node : elem && typeof elem === "object" && typeof elem.nodeType === "number" && typeof elem.nodeName==="string" && elem.nodeType !== 3)
            },
            isObj: function (v) {
                return (typeof v == "object")
            },
            replaceAt: function(str, index, char) {
                return str.substr(0, index) + char + str.substr(index + char.length);
            }
        }
    },
    //////////////////////////////////////
    // ok that's all the utilities      //
    // onto the select box / form stuff //
//////////////////////////////////////
    form = {
        f: {
            init: {
                register: function () {
                    var child, children = document.getElementsByClassName("field"), i
                    for (i = 0; i < children.length; i += 1) {
                        child = children[i]
                        util.f.addStyle(child, "Opacity", 1)
                    }
                    children = document.getElementsByClassName("psuedo_select")
                    for (i = 0; i < children.length; i += 1) {
                        child = children[i]
                        child.addEventListener("click", form.f.select.toggle)
                    }
                },
                unregister: function () {
                    //just here as a formallity
                    //call this to stop all ongoing timeouts are ready the page for some sort of json re-route
                }
            },
            select: {
                blur: function (field) {
                    field.classList.remove("focused")
                    var child, children = field.childNodes, i, ii, nested_child, nested_children
                    for (i = 0; i < children.length; i += 1) {
                        child = children[i]
                        if (util.f.isElem(child)) {
                            if (child.classList.contains("deselect")) {
                                child.parentNode.removeChild(child)
                            } else if (child.tagName == "SPAN") {
                                if (!field.dataset.value) {
                                    util.f.addStyle(child, ["FontSize", "Top"], ["16px", "32px"])
                                }
                            } else if (child.classList.contains("psuedo_select")) {
                                nested_children = child.childNodes
                                for (ii = 0; ii < nested_children.length; ii += 1) {
                                    nested_child = nested_children[ii]
                                    if (util.f.isElem(nested_child)) {
                                        if (nested_child.tagName == "SPAN") {
                                            if (!field.dataset.value) {
                                                util.f.addStyle(nested_child, ["Opacity", "Transform"], [0, "translateY(24px)"])
                                            }
                                        } else if (nested_child.tagName == "UL") {
                                            util.f.addStyle(nested_child, ["Height", "Opacity"], [0, 0])
                                        }
                                    }
                                }
                            }
                        }
                    }
                },
                focus: function (field) {
                    field.classList.add("focused")
                    var bool = false, child, children = field.childNodes, i, ii, iii, nested_child, nested_children, nested_nested_child, nested_nested_children, size = 0
                    for (i = 0; i < children.length; i += 1) {
                        child = children[i]
                        util.f.isElem(child) && child.classList.contains("deselect") ? bool = true : null
                    }
                    if (!bool) {
                        child = document.createElement("div")
                        child.className = "deselect"
                        child.addEventListener("click", form.f.select.toggle)
                        field.insertBefore(child, children[0])
                    }
                    for (i = 0; i < children.length; i += 1) {
                        child = children[i]
                        if (util.f.isElem(child) && child.classList.contains("psuedo_select")) {
                            nested_children = child.childNodes
                            for (ii = 0; ii < nested_children.length; ii += 1) {
                                nested_child = nested_children[ii]
                                if (util.f.isElem(nested_child) && nested_child.tagName == "UL") {
                                    size = 0
                                    nested_nested_children = nested_child.childNodes
                                    for (iii = 0; iii < nested_nested_children.length; iii += 1) {
                                        nested_nested_child = nested_nested_children[iii]
                                        if (util.f.isElem(nested_nested_child) && nested_nested_child.tagName == "LI") {
                                            size += util.f.getSize(nested_nested_child, "height")
                                        }
                                    }
                                    util.f.addStyle(nested_child, ["Height", "Opacity"], [size + "px", 1])
                                }
                            }
                        }
                    }
                },
                selection: function (child, parent) {
                    var children = parent.childNodes, i, ii, nested_child, nested_children, time = 0, value
                    if (util.f.isElem(child) && util.f.isElem(parent)) {
                        parent.dataset.value = child.dataset.value
                        value = child.innerHTML
                    }
                    for (i = 0; i < children.length; i += 1) {
                        child = children[i]
                        if (util.f.isElem(child)) {
                            if (child.classList.contains("psuedo_select")) {
                                nested_children = child.childNodes
                                for (ii = 0; ii < nested_children.length; ii += 1) {
                                    nested_child = nested_children[ii]
                                    if (util.f.isElem(nested_child) && nested_child.classList.contains("selected")) {
                                        if (nested_child.innerHTML)  {
                                            time = 1E2
                                            util.f.addStyle(nested_child, ["Opacity", "Transform"], [0, "translateY(24px)"], "all")
                                        }
                                        setTimeout(function (c, v) {
                                            c.innerHTML = v
                                            util.f.addStyle(c, ["Opacity", "Transform", "TransitionDuration"], [1, "translateY(0px)", ".1s"], "all")
                                        }, time, nested_child, value)
                                    }
                                }
                            } else if (child.tagName == "SPAN") {
                                util.f.addStyle(child, ["FontSize", "Top"], ["12px", "8px"])
                            }
                        }
                    }
                },
                toggle: function (event) {
                    util.f.events.stop(event)
                    var child = util.f.getTrg(event), children, i, parent
                    switch (true) {
                        case (child.classList.contains("psuedo_select")):
                        case (child.classList.contains("deselect")):
                            parent = child.parentNode
                            break
                        case (child.classList.contains("options")):
                            parent = child.parentNode.parentNode
                            break
                        case (child.classList.contains("option")):
                            parent = child.parentNode.parentNode.parentNode
                            form.f.select.selection(child, parent)
                            break
                    }
                    parent.classList.contains("focused") ? form.f.select.blur(parent) : form.f.select.focus(parent)
                }
            }
        }}