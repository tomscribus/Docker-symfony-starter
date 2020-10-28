
$( document ).ready(async function() {
    
    var data = await fetch('http://localhost/api/notification')
    var json = await data.json()

    var bell = $('#alertsDropdown')
    var panel = $("#content > nav > ul > li.nav-item.dropdown.no-arrow.mx-1 > div")

        for (let el of json) {

        const notif = `<a class="dropdown-item d-flex align-items-center" href="#">
        <div class="mr-3">
            <div class="icon-circle bg-success">
                <i class="fas fa-donate text-white"></i>
            </div>
        </div>
        <div>
            ${el.title}
        </div>
        </a>`
        panel.append(notif)
    }
})

