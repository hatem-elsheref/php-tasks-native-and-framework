
<footer class="footer mt-auto">
    <div class="copyright bg-white">
        <p class="text-center">&copy; {{date('Y',time())}} {{__(config('app.footer.message'))}}
            <a class="text-primary" href="{{config('app.footer.ownerUrl')}}" target="_blank">{{config('app.footer.ownerName')}}</a>.
        </p>
    </div>
</footer>

</div>
</div>

<script src="{{myAssets('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{myAssets('plugins/slimscrollbar/jquery.slimscroll.min.js')}}"></script>
<script src="{{myAssets('plugins/jquery-mask-input/jquery.mask.min.js')}}"></script>
<script src="{{myAssets('js/sleek.bundle.js')}}"></script>
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

    @if(app()->getLocale() === 'en')
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
            $("#sleek-css").attr("href", "{{myAssets('css/sleek.css')}}");
        else
            $("#sleek-css").attr("href", "{{myAssets('css/sleek.rtl.css')}}");
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
</body>

</html>
