<script>
    function menu(e) {
        let navbar = document.getElementById('sideNav');

        // console.log(navbar);
        e.name === 'opened' ?
            (e.name = "close", navbar.classList.add('block'), navbar.classList.remove('hidden')) :
            (e.name = "opened", navbar.classList.remove('block'), navbar.classList.add('hidden'));
    }

    function minimazeSideBar(e) {
        let sidebar = document.getElementById('sideNav');
        let navbar = document.getElementById('navbar');
        let content = document.getElementById('content-container');

        e.name === 'opened' ?
            (
                e.name = "close",
                sidebar.classList.add('-left-60'),
                content.classList.remove('lg:w-5/6'),
                navbar.classList.remove('lg:w-5/6')
            ) :
            (
                e.name = "opened",
                sidebar.classList.remove('-left-60'),
                content.classList.add('lg:w-5/6'),
                navbar.classList.add('lg:w-5/6')
            );

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
