<div class="contentNewQuestion">
    <h2 class="titlenewQuestion">paramétrer votre question </h2>
    <div class="cadreInterne">
        <form action="" method="post">
                <div class="questionNew">
                    <div class="positionLabelQuestion"> Question</div> 
                    <textarea name="question" id="question" cols="52" rows="4"></textarea>
                </div>
               
                <div class="nbQuestionNew">
                    <label class="label" for="points">Nbre de Points</label> 
                    <input class="nbPoint" type="number" name="points" value="">
                </div>
                <div class="nbQuestionNew">
                    <label class="label" for="points">Type de réponse</label> 
                    <select  name="points" value="">                       
                        <option value="">TESTE</option>
                        <option value="">TES</option>
                        <option value="">TSET</option>
                    </select> 
                    <input  class="addInpute" type="button" value="" onClick="addInput('newInput');">
                </div>
                <div id="newInput">

                </div>
            <input class="suivant" type="submit" value="Enregister">
        </form>
    </div>
</div>
