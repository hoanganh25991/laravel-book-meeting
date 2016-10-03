/**
 * Created by hoanganh25991 on 29/09/16.
 */
let rooms_file = document.querySelector('input[name="rooms_file"]');
rooms_file.addEventListener('change', handleFile);
function handleFile(e){
	let files = e.target.files;
	let f1 = files[0];
	let fileReader = new FileReader();
	fileReader.readAsBinaryString(f1);
	fileReader.onload = (e)=>{
		let data = e.target.result;
		//noinspection JSUnresolvedVariable
		let wb = XLSX.read(data, {type: 'binary'});
		// let wbJson = to_json(wb);
		// function to_json(workbook){
		// 	let result = {};
		// 	workbook.SheetNames.forEach(function(sheetName){
		// 		var rowObjArr = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
		// 		if(rowObjArr.length > 0){
		// 			result[sheetName] = rowObjArr;
		// 		}
		// 	});
		// 	return result;
		// };
		let wbJson = XLSX.utils.sheet_to_row_object_array(wb.Sheets['Sheet1']);
		wbJson.forEach((val)=>{
			var created_at = new Date().toISOString().slice(0, 19).replace('T', ' ');
			val.created_at = created_at;
			val.updated_at = created_at;
		});
		// console.log(wbJson);
		let wbJsonPre= document.querySelector('#wbJsonPre');
		let wbJsonStr = JSON.stringify(wbJson);
		wbJsonPre.innerHTML = wbJsonStr;

		let btnLoad = document.querySelector('#btnLoad');
		btnLoad.addEventListener('click', ()=>{
			$.post({
				url: '',
				data: {
					rooms: wbJsonStr
				},
				success: ()=>{console.log('success');},
				error: ()=>{console.log('error');}
			});
		});
	}
};