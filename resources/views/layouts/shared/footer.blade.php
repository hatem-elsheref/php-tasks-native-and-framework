
<footer class="footer mt-auto">
    <div class="copyright bg-white">
        <p class="text-center">&copy; {{date('Y',time())}} {{__(config('app.footer.message'))}}
            <a class="text-primary" href="{{config('app.footer.ownerUrl')}}" target="_blank">{{config('app.footer.ownerName')}}</a>.
        </p>
    </div>
</footer>

</div>
</div>

<script src="{{backendAssets('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{backendAssets('plugins/slimscrollbar/jquery.slimscroll.min.js')}}"></script>
<script src="{{backendAssets('plugins/jquery-mask-input/jquery.mask.min.js')}}"></script>
<script src="{{backendAssets('js/sleek.bundle.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>



        function RemoveItem(formId){
            Swal.fire({
                title: `<h3>{{__('backend.sure_remove')}}</h3>`,
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: '#dd6b55',
                confirmButtonText: `{{__('backend.sure')}}`,
                denyButtonText: `{{__('backend.dont_sure')}}`,
                cancelButtonText: `{{__('backend.dont_sure')}}`,

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $('#'+formId).submit();
                }
            })
        }

</script>
@yield('js')

<script>
    // show the uploaded image as a live preview
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#img-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
    $("#coverImage").change(function() {
      readURL(this);
    });


    // manage the system direction (rtl-ltr)
    $(document).ready(function () {
    var ltr = jQuery('.ltr-to');
    var rtl = jQuery('.rtl-to');

    @if(LaravelLocalization::getCurrentLocaleDirection() === 'ltr')
        activeTheNeededDirection(ltr,rtl,'ltr')
    @else
        activeTheNeededDirection(rtl,ltr,'rtl')
    @endif
    });
    function activeTheNeededDirection(newObject,oldObject,direction){
        jQuery(newObject).addClass('btn-right-sidebar-2-active');
        oldObject.removeClass('btn-right-sidebar-2-active');
        $('html').attr('dir', direction);
        if (direction === 'ltr')
            $("#sleek-css").attr("href", "{{backendAssets('css/sleek.css')}}");
        else
            $("#sleek-css").attr("href", "{{backendAssets('css/sleek.rtl.css')}}");
        window.dir = direction;

        //Store in local storage
        setOptions("direction", direction);
    }

    /**
     * Set local storage property value
     */
    function setOptions(propertyName, propertyValue) {
        let currentOptions = {
            headerType: "header-fixed",
            headerBackground: "header-light",
            navigationType: "sidebar-fixed",
            navigationBackground: "sidebar-dark",
            direction: "ltr"
        };
        //Store in local storage
        let optionsCopy = Object.assign({}, currentOptions);
        optionsCopy[propertyName] = propertyValue;

        //Store in local storage
        localStorage.setItem("optionsObject", JSON.stringify(optionsCopy));
    }


    </script>








<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var pusher = new Pusher('49db03239094e0d4e909', {
        cluster: 'eu'
    });
    var channel = pusher.subscribe('my-channel-'+{{auth('web')->id()}});
    channel.bind('today-is-the-same-day', function(data) {
        // console.log(JSON.stringify(data.subscriptionDetails.serviceName));
        console.log(JSON.stringify(data));

        let title=$('.the-notifications-messages-title');
        let total=parseInt(title.attr('data-total'));
        total++;
        let msg='{{__('backend.you_have_number_of_notifications')}}';
        msg=msg.replace("#",total.toString())
        title.html(msg);
        console.log(title.html());
        $('#put-the-new-notification-here').after(create_dom(data.subscriptionDetails.serviceName,data.subscriptionDetails.endDate));
        $('#mark-all-as-read').attr('hidden',false)

    });



    function create_dom(message,date){
        return `<li><a href="javascript:0"> <i class="mdi mdi-clock-end "></i> ${message}
                <span class=" font-size-12 d-inline-block float-right">
                <i class="mdi mdi-clock-outline"></i> ${date} </span>  </a> </li>`;
    }
</script>



</body>

</html>
