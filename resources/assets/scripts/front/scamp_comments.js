function replyOn(username){
    replyContent = $("#comment-body");
    oldContent = replyContent.val();
    prefix = "@" + username + " ";
    newContent = ''
    if(oldContent.length > 0){
        if (!(oldContent.indexOf(username)>0)) {
            newContent = oldContent + "\n" + prefix;
        } else {
            newContent = oldContent;
        }
    } else {
        newContent = prefix
    }
    replyContent.focus();
    replyContent.val(newContent);
    moveEnd($("#comment-body"));
}

var moveEnd = function(obj){
    obj.focus();

    var len = obj.value === undefined ? 0 : obj.value.length;

    if (document.selection) {
        var sel = obj.createTextRange();
        sel.moveStart('character',len);
        sel.collapse();
        sel.select();
    } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
        obj.selectionStart = obj.selectionEnd = len;
    }
}

function autoCompleteAtUser(){
    var at_users = [],
        user;
    $users = $('.media-heading').find('a.author_name');
    for (var i = 0; i < $users.length; i++) {
        user = $users.eq(i).text().trim();
        if ($.inArray(user, at_users) == -1) {
            at_users.push(user);
        };
    };

    $('textarea').textcomplete([{
        mentions: at_users,
        match: /\B@(\w*)$/,
        search: function(term, callback) {
            callback($.map(this.mentions, function(mention) {
                return mention.indexOf(term) === 0 ? mention : null;
            }));
        },
        index: 1,
        replace: function(mention) {
            return '@' + mention + ' ';
        }
    }], {
        appendTo: 'body'
    });

}

$(document).ready(function()
{
    autoCompleteAtUser();
});