<a
data-type="component" 
class="burgermeue" 
onclick="{{ $onClick }}" 
aria-expanded="false"
aria-owns="sprachauswahl-ul"
href="javascript:void(0);"
id="burgerButton"
aria-label="Zugang zur Seitennavigation und zur Sprachauswahl"
>
    <span></span>
    <span></span>
</a>

<!-- TODO: Javascript projektkonform auslagern, ggf eindampfen -->

<script>
    const burgerButton = document.querySelector("#burgerButton");
    document.addEventListener("DOMContentLoaded", () => {
        const overlay = document.querySelector('#overlay-navigation').querySelector('.overlay-section');
        
        burgerButton.addEventListener("click", () => {
            if(burgerButton.getAttribute("aria-expanded") === "false"){
                burgerButton.setAttribute("aria-expanded", "true");
                overlay.setAttribute("aria-hidden",false);
            }else{
                burgerButton.setAttribute("aria-expanded", "false");
                overlay.setAttribute("aria-hidden",true);
            }
        })
    });

</script>
