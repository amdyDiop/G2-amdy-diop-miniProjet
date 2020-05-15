<div class="contentNewQuestion">
    <h2 class="titlenewQuestion">paramétrer votre question </h2>
    <div class="cadreInterne">
        <form   action="" method="post"  name="newQuestion" onsubmit="return emptyQuestion();">
                <div class="questionNew">
                    <div class="positionLabelQuestion"> Question</div> 
                    <textarea  name="question" id="question" cols="16" rows="2"></textarea>
                </div>
                <div class="nbQuestionNew">
                    <label class="label" for="point">Nbre de Points</label>
                    <input class="nbPoint" type="number" name="point" value="">
                </div>
                <div class="nbQuestionNew">
                    <label class="label" for="typeReponse">Type de réponse</label>
                        <select  id="select" name="typeReponse" >
                            <option value="">Donnez le type de réponse</option>
                            <option value="multiple">Multiple</option>
                            <option value="simple">Choix Simple</option>
                            <option value="texte"> Choix Texte</option>
                        </select>
                    <input  class="addInpute" type="button" value="" onClick="addInput('newInput');">
                </div>
                <div id="newInput">
                </div>
            <input class="suivant" type="submit" value="Enregister" >
        </form>
    </div>
</div>
