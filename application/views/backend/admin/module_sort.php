<link rel="stylesheet" href="<?php echo base_url() . 'assets/backend/css/bootcamp.css' ?>">

<?php
$CI    = &get_instance();
$CI->load->database();
$modules = $CI->bootcamp_model->get_table('bootcamp_modules', 'bootcamp_id-' . $id, 'asc')->result_array();
?>


<?php if (count($modules)) : ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" id="parent-div" data-plugin="dragula" data-containers='["section-list"]'>
                        <div class="col-md-12">
                            <div class="bg-dragula p-2 p-lg-4">
                                <h5 class="mt-0"><?php echo get_phrase('list_of_sections'); ?>
                                    <button type="button" class="btn btn-outline-primary btn-sm btn-rounded alignToTitle" id="section-sort-btn" onclick="sort()" name="button"><?php echo get_phrase('update_sorting'); ?></button>
                                </h5>
                                <div id="section-list" class="py-2">
                                    <?php foreach ($modules as $module) : ?>
                                        <div class="card mb-0 mt-2 draggable-item" id="<?php echo $module['id']; ?>">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="mb-1 mt-0"><?php echo $module['title']; ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<script type="text/javascript">
    ! function(r) {
        "use strict";
        var a = function() {
            this.$body = r("body")
        };
        a.prototype.init = function() {
            r('[data-plugin="dragula"]').each(function() {
                var a = r(this).data("containers"),
                    t = [];
                if (a)
                    for (var n = 0; n < a.length; n++) t.push(r("#" + a[n])[0]);
                else t = [r(this)[0]];
                var i = r(this).data("handleclass");
                i ? dragula(t, {
                    moves: function(a, t, n) {
                        return n.classList.contains(i)
                    }
                }) : dragula(t)
            })
        }, r.Dragula = new a, r.Dragula.Constructor = a
    }(window.jQuery),
    function(a) {
        "use strict";
        window.jQuery.Dragula.init()
    }();
</script>
<script type="text/javascript">
    function sort() {
        var containerArray = ['section-list'];
        var itemArray = [];
        var itemJSON;
        for (var i = 0; i < containerArray.length; i++) {
            $('#' + containerArray[i]).each(function() {
                $(this).find('.draggable-item').each(function() {
                    //console.log(this.id);
                    itemArray.push(this.id);
                });
            });
        }

        itemJSON = JSON.stringify(itemArray);
        $.ajax({
            url: '<?php echo site_url('addons/bootcamp/module/update_sorted_modules'); ?>',
            type: 'POST',
            data: {
                itemJSON: itemJSON
            },
            success: function(response) {
                success_notify('<?php echo get_phrase('sections_have_been_sorted'); ?>');
                setTimeout(
                    function() {
                        location.reload();
                    }, 1000);

            }
        });
    }
    onDomChange(function() {
        $('#section-sort-btn').show();
    });
</script>