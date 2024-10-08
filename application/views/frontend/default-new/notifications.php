<?php
$logged_user_id = $this->session->userdata('user_id');
$notifications = $this->db->order_by('status ASC, id desc')->limit(50)->where('to_user', $logged_user_id)->get('notifications');
$number_of_unread_notification = $this->db->order_by('status ASC, id desc')->limit(50)->where('status', 0)->where('to_user', $logged_user_id)->get('notifications')->num_rows();
?>

<a class="menu_wisth_tgl mt-1 text-dark fs-6 rounded-3 gap-3 px-3" style="font-size: 0.7rem;">
    <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 15H17L15.595 13.595C15.4063 13.4063 15.2567 13.1822 15.1546 12.9357C15.0525 12.6891 15 12.4249 15 12.158V9C15.0002 7.75894 14.6156 6.54834 13.8992 5.53489C13.1829 4.52144 12.17 3.75496 11 3.341V3C11 2.46957 10.7893 1.96086 10.4142 1.58579C10.0391 1.21071 9.53043 1 9 1C8.46957 1 7.96086 1.21071 7.58579 1.58579C7.21071 1.96086 7 2.46957 7 3V3.341C4.67 4.165 3 6.388 3 9V12.159C3 12.697 2.786 13.214 2.405 13.595L1 15H6M12 15V16C12 16.7956 11.6839 17.5587 11.1213 18.1213C10.5587 18.6839 9.79565 19 9 19C8.20435 19 7.44129 18.6839 6.87868 18.1213C6.31607 17.5587 6 16.7956 6 16V15M12 15H6" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    <?php if ($number_of_unread_notification > 0) : ?>
        <p class="menu_number" style="font-size: 0.9rem;">
            <?php echo $number_of_unread_notification; ?>
        </p>
    <?php endif; ?>
</a>
<div class="menu_pro_wish" style="width: 275px;">
    <div class="w-100 d-flex">
        <a href="#" onclick="actionTo('<?php echo site_url('home/get_my_notification/remove_all'); ?>');" class="text-secondary ms-auto mt-3 me-3 btn btn-primary text-white fw-bold" style="background: #ff7468;">
            <small><?php echo get_phrase('Remove all'); ?></small>
        </a>
    </div>
    <div class="overflow-control" id="notifications">
        <?php foreach ($notifications->result_array() as $notification) : ?>
            <div class="notify-item cursor-pointer d-flex py-2 px-3 <?php if ($notification['status'] == 0) echo 'unread' ?>" style="width: 275px;">
                <?php if ($notification['type'] == 'signup') : ?>
                    <div class="notify-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                <?php else : ?>
                    <div class="notify-icon">
                        <i class="far fa-bell"></i>
                    </div>
                <?php endif; ?>
                <div class="ps-2">
                    <p class="notify-details text-13px">
                        <?php echo $notification['title']; ?>
                        <small class="text-muted float-end"><?php echo get_past_time($notification['created_at']); ?></small>
                    </p>
                    <div class="text-muted mb-0 user-msg text-13px">
                        <?php echo ($notification['description']); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if ($notifications->num_rows() == 0) : ?>
            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <img loading="lazy" width="100px" src="<?php echo site_url('assets/global/image/empty-notification.png'); ?>">
                    <h5 class="my-1 text-15px"><?php echo get_phrase('No notification'); ?></h5>
                    <p class="px-4 mx-3 my-1 text-13px text-muted"><small><?php echo get_phrase('Stay tuned!'); ?> <?php echo get_phrase('Notifications about your activity will show up here.'); ?></small></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="menu_pro_btn">
        <a href="#" onclick="actionTo('<?php echo site_url('home/get_my_notification/mark_all_as_read'); ?>');" class="btn btn-primary text-white"><?php echo get_phrase('Mark all as read'); ?></a>
    </div>
</div>