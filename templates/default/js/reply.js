addReply = {
	moveForm : function(replyId, parentId, respondId, postId) {
		var t = this, div, reply = t.I(replyId), respond = t.I(respondId), cancel = t.I('ideaboard-cancel-reply-to-link'), parent = t.I('ideaboard_reply_to'), post = t.I('ideaboard_topic_id');

		if ( ! reply || ! respond || ! cancel || ! parent )
			return;

		t.respondId = respondId;
		postId = postId || false;

		if ( ! t.I('ideaboard-temp-form-div') ) {
			div = document.createElement('div');
			div.id = 'ideaboard-temp-form-div';
			div.style.display = 'none';
			respond.parentNode.insertBefore(div, respond);
		}

		reply.parentNode.insertBefore(respond);
		if ( post && postId )
			post.value = postId;
		parent.value = parentId;
		cancel.style.display = '';

		cancel.onclick = function() {
			var t = addReply, temp = t.I('ideaboard-temp-form-div'), respond = t.I(t.respondId);

			if ( ! temp || ! respond )
				return;

			t.I('ideaboard_reply_to').value = '0';
			temp.parentNode.insertBefore(respond, temp);
			temp.parentNode.removeChild(temp);
			this.style.display = 'none';
			this.onclick = null;
			return false;
		}

		try { t.I('ideaboard_reply_content').focus(); }
		catch(e) {}

		return false;
	},

	I : function(e) {
		return document.getElementById(e);
	}
}
