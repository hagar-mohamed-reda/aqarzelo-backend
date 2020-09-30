
                 <div class="top-step-bar light-theme-background" >
                   <button
                    onclick="goto(3)" 
                    class="btn w3-round-xxlarge w3-large"  >
                    <b 
                    class="w3-badge" 
                    v-bind:class="step >= 3? 'w3-white' : 'w3-gray'" >1</b>
                   </button>
                   <button
                    onclick="goto(4)" 
                     class="btn w3-round-xxlarge w3-large"   >
                    <b 
                    class="w3-badge"
                    v-bind:class="step >= 4? 'w3-white' : 'w3-gray'" >2</b>
                   </button>
                   <button
                    onclick="goto(5)" 
                     class="btn w3-round-xxlarge w3-large"   >
                    <b 
                    class="w3-badge"
                    style="border-bottom-right-radius: 0px;"
                    v-bind:class="step >= 5? 'w3-white' : 'w3-gray'" >3</b>
                   </button>

                </div>
 