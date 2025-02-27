<form id="quizz-form" class="row" method="post">
    <h1 class="h1 pt-2 pb-2 text-center">Quizz</h1>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="quizz[title]" value="<?= $quizz['title'] ?>">
        <input type="hidden" name="quizz[published]" value="0">
        <div class="form-check form-switch" style="margin-left: 12em;">
            <input class="form-check-input" type="checkbox" role="switch" id="published" name="quizz[published]" value="1" <?= $quizz['published'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="flexSwitchCheckDefault">Published</label>
        </div>
    </div>
    <?php foreach ($quizz['questions'] as $question): ?>
    <div class="mb-3" style="margin-left: 2em;">
        <label for="question-<?= $question['id'] ?>" class="form-label">Question</label>
        <input type="hidden" name="questions[<?= $question['id'] ?>][id]" value="<?= $question['id'] ?>">
        <input type="text" class="form-control" id="question-<?= $question['id'] ?>" name="questions[<?= $question['id'] ?>][question]" value="<?= $question['question'] ?>">
        <input type="hidden" name="questions[<?= $question['id'] ?>][multi]" value="0">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="multiple-<?= $question['id'] ?>" name="questions[<?= $question['id'] ?>][multi]" value="1" <?= $question['multi'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="flexSwitchCheckDefault">Multiple Choice</label>
        </div>
        <?php if (!empty($question['answers'])): ?>
            <?php foreach ($question['answers'] as $answer): ?>
            <div class="mb-3" style="margin-left: 2em;">
                <label for="answer-<?= $answer['id'] ?>" class="form-label">Answer</label>
                <input type="hidden" name="questions[<?= $question['id'] ?>][answers][<?= $answer['id'] ?>][id]" value="<?= $answer['id'] ?>">
                <input type="text" class="form-control" id="answer-<?= $answer['id'] ?>" name="questions[<?= $question['id'] ?>][answers][<?= $answer['id'] ?>][text]" value="<?= $answer['text'] ?>">
                <span>points: </span><input type="text" name="questions[<?= $question['id'] ?>][answers][<?= $answer['id'] ?>][points]" value="<?= $answer['points'] ?? 0 ?>">
                <input type="hidden" name="questions[<?= $question['id'] ?>][answers][<?= $answer['id'] ?>][correct]" value="0">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="correct-answer-<?= $answer['id'] ?>" name="questions[<?= $question['id'] ?>][answers][<?= $answer['id'] ?>][correct]" value="1" <?= $answer['correct'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Correct</label>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
    <button type="submit" class="btn btn-primary" style="    
        position: fixed;
        bottom: 0px;
        left: 400px;
        width: 400px;
        margin-top: 20px;
        z-index: 1000;" >Submit</button>    
</form>
