/**
 * Reset settings button
 */

jQuery(document).ready(function(){
    jQuery('.rat-toolbar input[value="Reset Settings"]').on('click', function () {
        jQuery('.rat-toolbar input[name="rat-toolbar-radio"]').prop('checked', false);
    });
});
