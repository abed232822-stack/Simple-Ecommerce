<script >
    function addToQuantity ()
    {
        let input=document.getElementById('quantityOfProduct');
        input.value=parseInt(input.value)+1;
    }
    function reduceFromQuantity ()
    {
        let input=document.getElementById('quantityOfProduct');
        if (parseInt(input.value)>0)
        {
            input.value=parseInt(input.value)-1;
        }
    }
</script>
@props(['name'])
<div class="flex">
        <button type="button" class="hover:cursor-pointer w-8 h-8 border border-r-0 border-gray-500 text-xl rounded-bl-md rounded-tl-md hover:bg-[#db4444] hover:border-[#db4444] hover:text-white transition-all" onclick="addToQuantity()">+</button>
        <input name="{{ $name }}" id="quantityOfProduct" type="text" class="w-14 h-8 border  border-gray-500 outline-0 text-center " value="1" readonly />
        <button  type="button" class="hover:cursor-pointer w-8 h-8 border border-l-0 border-gray-500 text-xl rounded-br-md rounded-tr-md hover:bg-[#db4444] hover:border-[#db4444] hover:text-white transition-all" onclick="reduceFromQuantity()">-</button>
    </div>