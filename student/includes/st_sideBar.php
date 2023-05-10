<style>
    .sideLink .active{
        color: #1a1a1a !important;
        border-right: 3px solid #ff3636;
        background: rgb(2,0,36);
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(255,255,255,0) 0%, rgba(255,226,226,0.7987570028011204) 100%);
    }
    .doc_card:hover .docCardIMG {
        height: 120px; /* set the desired increased height */
    }

    .docCardIMG {
        transition: all 0.3s ease;
        position: relative;
        height: 80px; /* set the desired height of the container */
        overflow: hidden;
    }

    .docCardIMG img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: auto;
        object-fit: cover;
    }
</style>
<div class="px-3" style="border-radius: 0 0 1em 1em; background: #d54b4b">
    <div style="max-width: 70px; padding: 1.5em 0">
        <div class="d-flex justify-content-center">
            <a href="#" class="hmbrgr four"></a>
        </div>
    </div>

    <div class="w-100 py-3 me-3">
        <div id="btn" class="card-img rounded-circle m-auto" style="max-width: 4.5rem; max-height: 4.5rem; border: 2px solid white">
            <img src="../img/logo.png" class="" style="width: 100%; object-fit: cover" alt="logo">
        </div>
        <div class="tlink fs-4 mt-2 fw-bolder text-light text-center overflow-hidden">REGISTRAR</div>
        <div class="tlink text-light text-center" style="font-size: .8rem; font-family: 'Poppins', sans-serif">Student Portal</div>
    </div>
</div>

<div class="mt-4 sideLink">
    <ul id="menu" class="m-0 p-0" style="list-style: none">
        <li>
            <a href="st_main.php" class="d-flex py-3 links text-decoration-none">
                <div class="iContainer mx-3">
                    <i class="fa-solid fa-list-1-2 fs-5"></i>
                </div>
                <span class="tlink p-1 overflow-hidden">My Request</span>
            </a>
        </li>
        <li>
            <a href="archive.php" class="d-flex py-3 links text-decoration-none">
                <div class="iContainer mx-3">
                    <i class="fa-solid fa-box-archive fs-5"></i>
                </div>
                <span class="tlink p-1 overflow-hidden">Archive</span>
            </a>
        </li>
    </ul>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../assets/js/jquery.hmbrgr.js"></script>
<script src="../assets/js/sidebar.js"></script>

<script type="text/javascript">
    $(document).ready(function ($){
        var path = window.location.pathname.split("/").pop();
        if (path === ''){
            path = 'ad_main.php';
        }
        var target = $('ul li a[href="'+path+'"]');
        target.addClass('active');
    });
</script>