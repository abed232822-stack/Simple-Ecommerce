import './bootstrap';
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