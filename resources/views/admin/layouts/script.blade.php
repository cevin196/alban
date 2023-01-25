<script>
    function menu(e) {
        let navbar = document.getElementById('sideNav');

        // console.log(navbar);
        e.name === 'opened' ? (e.name = "close", navbar.classList.add(
            'opacity-100')) : (e.name = "opened", navbar.classList.remove(
            'opacity-100'));
    }
</script>

<!-- Required popper.js -->
<script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
<script type="text/javascript">
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new Tooltip(tooltipTriggerEl);
    });
</script>
