<?php
$application_details = $this->user_model->get_applications($param2, 'application')->row_array();
$applicant_details = $this->user_model->get_all_user($application_details['user_id'])->row_array();
?>
<div class="text-center mb-2">
    <img class="mr-2 rounded-circle" src="<?php echo $this->user_model->get_user_image_url($applicant_details['id']); ?>" alt="" height="80">
</div>
<div class="table-responsive-sm">
    <table class="table table-bordered table-centered mb-0">
        <tbody>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('applicant'); ?></strong></td>
                <td><?php echo $applicant_details['first_name'].' '.$applicant_details['last_name']; ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('email'); ?></strong></td>
                <td><?php echo $applicant_details['email']; ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('phone_number'); ?></strong></td>
                <td><?php echo $application_details['phone']; ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('address'); ?></strong></td>
                <td><?php echo $application_details['address']; ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('country'); ?></strong></td>
                <td><?php echo $application_details['country_code']; ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('mother_language'); ?></strong></td>
                <td>
                    <?php 
                        $langs = explode(',', $application_details['mother_language']);
                        foreach($langs as $key => $lang)
                        {
                            $langs[$key] = match($lang){
                                '0' => get_phrase('english'),
                                '1' => get_phrase('arabic'),
                                '2' => get_phrase('french'),
                                '3' => get_phrase('other'),
                                default => $lang
                            };
                        }
                        echo implode(',', $langs);
                    ?>
                </td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('other_language'); ?></strong></td>
                <td><?php echo $application_details['other_language']; ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('gender'); ?></strong></td>
                <td><?php echo ($application_details['gender'] == 1) ? get_phrase('male') : get_phrase('fe-male'); ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('teacher_apply_as'); ?></strong></td>
                <td><?php echo ($application_details['job_type'] == 1) ? get_phrase('full-time-tutor') : get_phrase('part-time-tutor'); ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('teacher_subjects'); ?></strong></td>
                <td>
                    <?php
                        $subjects = explode(',', $application_details['subjects']); 
                        foreach($subjects as $key => $subject)
                        {
                            $subjects[$key] = match($subject){
                                '0' => get_phrase('arabic'),
                                '1' => get_phrase('english'),
                                '2' => get_phrase('math'),
                                '3' => get_phrase('science'),
                                '4' => get_phrase('physics'),
                                '5' => get_phrase('chemistry'),
                                '6' => get_phrase('biology'),
                                '7' => get_phrase('islamic'),
                                '8' => get_phrase('robotics'),
                                default => $subject
                            };
                        }
                        echo implode(',', $subjects);
                    ?>
                </td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('how_to_conduct'); ?></strong></td>
                <td>
                    <?php
                        echo match($application_details['how_to_conduct']){
                            '0' => get_phrase('online'),
                            '1' => get_phrase('in-person'),
                            '2' => get_phrase('both')
                        };
                    ?>
                </td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('prefered-school-level'); ?></strong></td>
                <td>
                    <?php
                        $levels = explode(',', $application_details['school_level']); 
                        foreach($levels as $key => $level)
                        {
                            $levels[$key] = match($level){
                                '0' => get_phrase('elementary-school'),
                                '1' => get_phrase('middle-school'),
                                '2' => get_phrase('high-school'),
                                '3' => get_phrase('university-school'),
                            };
                        }
                        echo implode(',', $levels);
                    ?>
                </td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('are_you_committed_to_any_other_job_now'); ?></strong></td>
                <td><?php echo ($application_details['current_job'] == 1) ? get_phrase('yes') : get_phrase('no'); ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('do-you-have-experince-in'); ?></strong></td>
                <td><?php echo ($application_details['current_job'] == 1) ? get_phrase('special-education') : get_phrase('early-education'); ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('experince-years'); ?></strong></td>
                <td><?php echo $application_details['experince_years']; ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('how-did-you-hear'); ?></strong></td>
                <td><?php echo $application_details['affiliate']; ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('message'); ?></strong></td>
                <td><?php echo $application_details['message']; ?></td>
            </tr>
            <tr class="text-center">
                <td><strong><?php echo get_phrase('status'); ?></strong></td>
                <td><?php if ($application_details['status']): ?><span class="badge badge-success"><?php echo get_phrase('approved'); ?></span> <?php else: ?><span class="badge badge-danger"><?php echo get_phrase('pending'); ?></span><?php endif; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
