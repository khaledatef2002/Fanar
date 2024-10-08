<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">

<div class="course-description">
    <h3 class="description-head"><?php echo get_phrase('bootcamp_description') ?></h3>
    <?php echo $bootcamp_details['description']; ?>
</div>

<div class="course-description">
    <h3 class="description-head"><?php echo get_phrase('What will i learn?') ?></h3>
    <ul class="step-down">
        <?php foreach (json_decode($bootcamp_details['outcomes']) as $outcome) : ?>
            <?php if ($outcome != "") : ?>
                <li><?php echo $outcome; ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>

<div class="course-description requirements">
    <h3 class="description-head"><?php echo get_phrase('Requirements') ?></h3>
    <ul>
        <?php foreach (json_decode($bootcamp_details['requirements']) as $requirement) : ?>
            <?php if ($requirement != "") : ?>
                <li><?php echo $requirement; ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>

<?php
$faqs = json_decode($bootcamp_details['faqs'], true);
$faqs_answers = json_decode($bootcamp_details['faq_descriptions'], true); ?>

<?php if (count($faqs) > 0) : ?>
    <div class="course-description">
        <h3 class="description-head"><?php echo get_phrase('Frequently asked question') ?></h3>

        <div class="faq-accrodion m-0">
            <?php for ($i = 0; $i < count($faqs); $i++) : ?>
                <div class="accordion">
                    <div class="accordion-item radius-0">
                        <h2 class="accordion-header" id="faq<?php echo $i; ?>">
                            <button class="faq accordion-button collapsed text-18px mt-20px" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-<?php echo $i; ?>" aria-expanded="false" aria-controls="panelsStayOpen-<?php echo $i; ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><?php echo $faqs[$i]; ?></span>
                                    <span class="module_expand_icon">
                                        <i class="fas fa-chevron-down"></i>
                                    </span>
                                </div>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="faq<?php echo $i; ?>">
                            <div class="accordion-body pt-0">
                                <?php echo $faqs_answers[$i]; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
<?php endif; ?>

<style>
    .course-description {
        margin: 0 !important;
    }
</style>