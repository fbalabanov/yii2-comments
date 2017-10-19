(function ($) {
  $.fn.yiiCommentsList = function (method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method) {
      return methods.init.apply(this, arguments);
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.yiiCommentsList');
      return false;
    }
  };

  var $body = $('body'),
    commentsData = [];

  var methods = {
    init: function (comments) {
      commentsData = comments;
    }
  };

  $body.on('click', '[data-role="reply"]', function (e) {
    var comment_id = $(this).closest('[data-comment]').data('comment');
    var $textarea = $('textarea[data-role="new-comment"]');
    var $parentIdInput = $('input[data-role="new-comment-parent-id"]');

    $textarea
      .focus()
      .val(blockquote(commentsData[comment_id].text));
    $parentIdInput.val(comment_id);

    location.hash = null;
    location.hash = 'commentcreateform?tab=comments';

    e.preventDefault();
  });

  $body.on('click', '[data-role="edit"]', function (e) {
    var $link = $(this),
      $comment = $link.closest('[data-comment]'),
      comment_id = $comment.data('comment'),
      comment = commentsData[comment_id],
      $edit_block = $comment.find('.edit');

    $edit_block.show();

    $edit_block.find('form').bind('reset', function () {
      $edit_block.hide();
    });

    e.preventDefault();
  });

  function blockquote(text) {
    return text.split('\n').map(function (value) {
        return '> ' + value;
      }).join('\n') + '\n\n';
  }
})(window.jQuery);
