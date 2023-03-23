<script>
    function menu(e) {
        let navbar = document.getElementById('sideNav');

        // console.log(navbar);
        e.name === 'opened' ?
            (e.name = "close", navbar.classList.add('block'), navbar.classList.remove('hidden')) :
            (e.name = "opened", navbar.classList.remove('block'), navbar.classList.add('hidden'));
    }

    // window.onscroll = function() {
    //     scrollFunction()
    // };

    // function scrollFunction() {
    //     let navbar = document.getElementById('navbar');

    //     if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    //         // navbar.classList.remove('bg-black');
    //         navbar.classList.add('shadow-[0_4px_4px_0px_rgb(0,0,0,0.1)]');
    //     } else {
    //         navbar.classList.remove('shadow-[0_4px_4px_0px_rgb(0,0,0,0.1)]');
    //         // navbar.classList.add('bg-black');
    //     }

    // }
</script>


@section('script')
@show
