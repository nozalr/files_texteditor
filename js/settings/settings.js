$(document).ready(function() {
	var Files_Texteditor = {
		isGlobal: false,

		changeSettings(target) {
			if (target) {
				var name = target.name;
				var value = target.value;
				this.uploadSetting(name, value);
			}
		},
		uploadSetting(key, value) {
			var url;
			var urlType = this.isGlobal ? "global" : "user";
			url = OC.generateUrl(
				"apps/files_texteditor/ajax/settings/" + urlType
			);
			$.post(url, { key: key, value: value })
				.done(function(data) {
					// var status = data && data.status (ok)
					OC.Notification.showTemporary(
						t("files_texteditor", "Saved")
					);
				})
				.fail(function(data) {
					OC.Notification.showTemporary(
						t(
							"files_texteditor",
							"There was a problem saving your changes."
						)
					);
				});
		},
		initialize() {
			var that = this;

			var $mode = $("#settings-mode");
			if ($mode.length) {
				var value = $mode.attr("value");
				if (value === "global") {
					this.isGlobal = true;
				}
			}

			var $select = $("#editor-keybindings");
			if ($select.length) {
				$select.on("change", function(ev) {
					that.changeSettings(ev.target);
				});
			}
		}
	};

	Files_Texteditor.initialize();
	OCA.Files_Texteditor = Files_Texteditor;
});
