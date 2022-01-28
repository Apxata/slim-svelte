<script>
    import {metatags, goto} from '@roxi/routify'
    import {Authenticate} from "../../service/Auth";


    metatags.title = 'Admin Page'
    metatags.description = 'Description coming soon...'

    let user = Authenticate();

    if (!user) {
        $goto('/login');
    }

</script>

<div class="relative min-h-screen flex">
    <!--    sidebar-->
    <div class="bg-blue-800 text-blue-100 w-64">
        <!--logo-->

        <nav>

        </nav>
    </div>
    <!--    content-->
    <div>content</div>
</div>



