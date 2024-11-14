import './bootstrap';

if (role === "user") {
    window.Echo.private('App.Models.User.' + userId)
        .notification((event) => {
            console.log(event.username)
            let link = postRoute.replace(':slug', event.post_slug )+'?notify='+event.id;
            $('#push_notification').prepend(`
        <div class="dropdown-item d-flex justify-content-between align-items-center">
            <span class="dropdown-item">comment by: ${event.username} </span>
            <a href="${link}"><i class="fas fa-eye"></i></a>
        </div>
        `)
            var count = Number($('#num_Notifi').text());
            count++;
            $('#num_Notifi').text(count);
        })
        .error((error) => {
            console.error('Error:', error);
        });

}

if (role === "admin") {

    window.Echo.private('App.Models.Admin.' + adminId)
        .notification((event) => {
            console.log(event.name);
            $('#notify_push').prepend(`
                    <a class="dropdown-item d-flex align-items-center" href="${event.link}?notify_admin=${event.id}">
                       <div class="mr-3">
                           <div class="icon-circle bg-primary">
                               <i class="fas fa-file-alt text-white"></i>
                           </div>
                       </div>
                       <div>
                           <div class="small text-gray-500">${event.date}</div>

                           <span class="font-weight-bold">${event.name} send </span>
                           <span class="font-weight-bold">message : ${event.body} </span>
                       </div>
                   </a>
        `)
            var count = Number($('#notify_count').text());
            count++;
            $('#notify_count').text(count);

        })
        .error((error) => {
            console.error('Error while joining the channel:', error);  // عرض تفاصيل الخطأ
        });
}

