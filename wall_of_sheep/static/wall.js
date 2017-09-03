const max_num = 14;

let socket = new WebSocket("ws://localhost:9501");
socket.onmessage = function(event) {
	console.log(event.data);
	let data = JSON.parse(event.data);
    let type = data.type;
	listInfo(type, data);
};

function listInfo(type, data) {
	
	if (type == "0") {
		let id = $('#probe');
		let len = id.children().length;
		if (len > max_num)
			id.children()[len-1].remove();
		id.prepend(`{
			<tr>
				<td>${data["src_mac"]}</td>
				<td class="font-lower">${data["wifi_name"]}</td>
			</tr>
		}`);
	}else {
		let id = $('#list');
		let len = id.children().length;
		if (len > max_num)
			id.children()[len-1].remove();
		id.prepend(`
			<tr>
				<td>${data["src_mac"]}</td>
				<td>${data["src_ip"]}</td>
				<td>${data["dst_ip"]}</td>
				<td>${data["url"]}</td>
				<td>${data["cookie"].substring(0,10)}</td>
				<td>${data["ua"].substring(0, 30)}</td>
			</tr>
		}`);
	}
}