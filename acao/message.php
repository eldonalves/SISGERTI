<?php
 class Message{
   static function sendMessage(){
     if(!empty($_SESSION["message"]["text"])){
       echo $_SESSION["message"]["text"];
       unset($_SESSION["message"]);
     }
   }
   static function createMessage($text, $tipo){
     switch($tipo){
       case "1":
          $text = "
          <div class=\"alert modal fade show\" tabindex=\"-1\" role=\"dialog\">
            <div class=\"modal-dialog\" role=\"document\">
              <div class=\"modal-content\">
                <div class=\"modal-header\">
                  <h5 class=\"modal-title\">Aviso</h5>
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Fechar\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>
                <div class=\"modal-body text-danger\">
                  <p>{$text}</p>
                </div>
                <div class=\"modal-footer\">
                </div>
              </div>
            </div>
          </div>
          <script>
            $('.alert').modal(\"show\");
          </script>
          ";
        break;
       case "2":
       $text = "
       <div class=\"alert modal fade show\" tabindex=\"-1\" role=\"dialog\">
         <div class=\"modal-dialog\" role=\"document\">
           <div class=\"modal-content\">
             <div class=\"modal-header\">
               <h5 class=\"modal-title\">Aviso</h5>
               <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Fechar\">
                 <span aria-hidden=\"true\">&times;</span>
               </button>
             </div>
             <div class=\"modal-body text-success\">
               <p>{$text}</p>
             </div>
             <div class=\"modal-footer\">
             </div>
           </div>
         </div>
       </div>
       <script>
         $('.alert').modal(\"show\");
       </script>
       ";
        break;
     }
     $_SESSION["message"]["text"] = $text;
   }
 }
?>
