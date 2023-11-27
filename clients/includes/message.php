<style>
    :root {
        --btnbookNow-primaryColor: #8b0021;
        --btnbookNow-shadowColor: rgba(169, 0, 40, 0.6);
    }

    .fui-button-book-now {
        /* display: none; */
        position: fixed;
        top: 80%;
        z-index: 999;
        right: 0%;
    }

    .fui-button-book-now .btn-link {
        display: flex;
        align-items: center;
    }

    .fui-button-book-now svg {
        display: inline-block;
        width: 17px;
        height: 32px;
        margin-right: 30px;
        position: relative;
        z-index: 3;
    }

    .fui-button-book-now a {
        transition: linear 0.25s;
        color: white;
        font-size: 18px;
        line-height: 24px;
        font-weight: 700;
        text-transform: uppercase;
        display: block;
        padding: 10px 20px 10px 18px;
        border-radius: 30px;
        background-color: var(--btnbookNow-primaryColor);
        border: 2px solid var(--btnbookNow-primaryColor);
        position: relative;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    .fui-button-book-now a::before {
        position: absolute;
        top: 4px;
        left: 5px;
        width: 42px;
        height: 42px;
        content: "";
        background-color: #a90028;
        border-radius: 100rem;
        z-index: 1;
    }

    .fui-button-book-now a::after {
        position: absolute;
        top: 4px;
        left: 5px;
        width: 42px;
        height: 42px;
        content: "";
        border-radius: 100rem;
        z-index: 0;
        animation: ripple-wave-book 3s linear infinite;
        animation-play-state: running;
    }

    .fui-button-book-now a:hover {
        background-color: white;
        color: var(--btnbookNow-primaryColor);
    }

    .fui-button-book-now a:hover svg {
        color: white;
    }

    @keyframes ripple-wave-book {
        0% {
            box-shadow: 0 0 var(--btnbookNow-shadowColor), 0 0 0 5px var(--btnbookNow-shadowColor), 0 0 0 15px var(--btnbookNow-shadowColor);
            opacity: 1;
        }

        50% {
            box-shadow: 0 0 0 10px var(--btnbookNow-shadowColor), 0 0 0 20px var(--btnbookNow-shadowColor), 0 0 0 30px var(--btnbookNow-shadowColor);
            opacity: 1;
        }

        95% {
            opacity: 0;
        }

        100% {
            box-shadow: 0 0 var(--btnbookNow-shadowColor), 0 0 0 5px var(--btnbookNow-shadowColor), 0 0 0 15px var(--btnbookNow-shadowColor);
            opacity: 1;
        }
    }
</style>
<div class="fui-button-book-now">
    <a class="btn-link" href=""  data-toggle="modal" data-target="#modalBookRoom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
            <path fill="currentColor" d="M560 448H512V113.5c0-27.25-21.5-49.5-48-49.5L352 64.01V128h96V512h112c8.875 0 16-7.125 16-15.1v-31.1C576 455.1 568.9 448 560 448zM280.3 1.007l-192 49.75C73.1 54.51 64 67.76 64 82.88V448H16c-8.875 0-16 7.125-16 15.1v31.1C0 504.9 7.125 512 16 512H320V33.13C320 11.63 300.5-4.243 280.3 1.007zM232 288c-13.25 0-24-14.37-24-31.1c0-17.62 10.75-31.1 24-31.1S256 238.4 256 256C256 273.6 245.3 288 232 288z"></path>
        </svg>
        Chat Now
    </a>

</div>