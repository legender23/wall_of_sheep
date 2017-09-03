const max_num = 20;
let socket = new WebSocket("ws://123.207.63.246:9501");
socket.onmessage = function(event) {
	console.log(event.data);
	let data = JSON.parse(event.data);
	let type = data.type;
	listInfo(type, data);
};

function listInfo(type, data) {
	//let dict = createInfo();
	if (type == "0") {
		let id = $('#probe');
		let len = id.children().length;
		if (len > max_num)
			id.children()[len-1].remove();
		id.prepend(`{
			<tr class="listinfo">
				<td>${data["src_mac"]}</td>
				<td>${data["wifi_name"]}</td>
			</tr>
		}`);
	}else {
		let id = $('#list');
		let len = id.children().length;
		if (len > max_num)
			id.children()[len-1].remove();
		id.prepend(`
			<tr class="listinfo">
				<td>${data["src_mac"]}</td>
				<td>${data["src_ip"]}</td>
				<td>${data["dst_ip"]}</td>
				<td>${data["url"]}</td>
				<td>${data["cookie"]}</td>
				<td>${data["ua"]}</td>
			</tr>
		}`);
	}
}

//setInterval("listInfo()", 1000);