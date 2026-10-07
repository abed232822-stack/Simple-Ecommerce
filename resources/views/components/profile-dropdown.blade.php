<div class="relative inline-block">
    <button type="button" onclick="hide()">
        <svg xmlns="http://www.w3.org/2000/svg" class="hover:cursor-pointer" height="24px" viewBox="0 -960 960 960" width="24px" fill="current currentColor"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
    </button>
    <div id="profile_menu" class="text-xs  opacity-0 scale-95 transition-all  hidden absolute right-0 mt-2 w-44 bg-black shadow-xl rounded-md py-1 flex flex-col pl-2 py-2 gap-y-2 text-white">
        <p >{{ Auth::user()->name }}</p>
        <p >{{ Auth::user()->email }}</p>
        <p >{{ Auth::user()->role }}</p>
        @if (!is_null(Auth::user()->balance))
            <p class="pl-1">Your Balance is : ${{ Auth::user()->balance }}</p>
        @endif
        <form action="{{ route('logout') }}" method="Post" >
            @csrf
            @method('DELETE')
            <button type="submit" class="hover:cursor-pointer" >Logout</button>
        </form>
    </div>
</div>
<script>
    function hide()
    {
        let dropdown=document.getElementById('profile_menu');
        if (dropdown.classList.contains("hidden"))
        {
            dropdown.classList.remove("hidden");
            dropdown.classList.remove("opacity-0","scale-95");
        }
        else 
        {
            dropdown.classList.add("opacity-0","scale-95");
            setTimeout(() => dropdown.classList.add("hidden"), 200);
        }
    }
</script>