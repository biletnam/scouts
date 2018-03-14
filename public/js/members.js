var selected = 0;
$(function() {
    $("button.copy").click(function(e) {
        e.preventDefault();
        var $emails = $(this).siblings('.email-list').find('.addresses');
        var $temp = $('<input>');
        $(this).siblings('.email-list').slideToggle();
        $("body").append($temp);
        $temp.val($emails.val()).select();
        document.execCommand("copy");
        $temp.remove();
        $('copy-confirm').fadeIn('slow');
        setTimeout(function () {
            $('copy-confirm').fadeOut('slow');
        }, 5000);
    });	
    
    $('.paid i').click(function() {
        $el = $(this);
        $.post('leiding/ledenlijst/toggle-paid/'+ $(this).data('id'), {_token: Laravel.csrfToken}, function(result) {
            $el.toggleClass('fa-check').toggleClass('fa-remove');
        });
    });
    
    $('.select').change(function() {
        selected = $('.select:checked').length;
        if (selected > 0) { $('#action').prop('disabled', false); }
        else { $('#action').prop('disabled', true) }
    });
    
    $('#action').change(function() {
        if (selected > 0) { this.form.submit(); }
    });
    $('input[name="existing"]').change(function() {
        if ($('input[name="existing"]:checked').val() === '0') {
            $('.contact-form').show();
            $('.existing').hide();
        } else {
            $('.contact-form').hide();
            $('.existing').show();
        }
    });
    
    $('input[name="own_contact"]').change(function() {
        if ($('input[name="own_contact"]:checked').val() === '0') {
            $('input[name="contact[name]"]').closest('.row').show();
        } else {
            $('input[name="contact[name]"]').closest('.row').hide();
        }
    });
    
    if ($('.existing select#member').length > 0) {
        $('.existing select#member').select2({
	        placeholder: 'Kies een lid',
            ajax: {
                url: base_url+"/leiding/ledenlijst/get-ajax",
                dataType: 'json',
                delay: 250,
	            minimumInputLength: 1,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            // let our custom formatter work
            templateResult: formatMember,
            // omitted for brevity, see the source of this page
            templateSelection: formatMemberSelection
            // omitted for brevity, see the source of this page
        });

	    $('.existing select#member').change(function() {
			$.getJSON('/leiding/contacts/get-for-member-ajax/' + $(this).val(), function(data) {
				$('.existing .contacts').empty();
				$.each(data, function (i,v) {
					var li = '<li><label><input type="checkbox" name="contacts[]" value="' + v.id + '">' + v.name + ' (' + v.email + ')</label></li>';
					$('.existing .contacts').append(li);
				});
			});
        });
    }


    $("#checks").on("change", "input:checkbox", function() {
        $("#checks").submit();
    });
    $("#printLink").click(function(e) {
        e.preventDefault();
        window.print();
    });
});
    
function formatMember(member){
    if (member.loading) {
        return member.text;
    }
    return '<div class="selectbox-result"><div class="col-sm-12"><div class="row"><div class="col-sm-12"><p class="name">'+member.text+"</p></div></div></div></div>";
}

function formatMemberSelection(a){ return a.text }
