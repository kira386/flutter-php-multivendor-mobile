import 'dart:convert';
import 'package:http/http.dart' as http;
class ApiClient{
 static const baseUrl='http://10.0.2.2/marketgo/backend/public/api';
 String? token;
 Map<String,String> get headers=>{'Content-Type':'application/json',if(token!=null)'Authorization':'Bearer $token'};
 Future<List<dynamic>> products()async{final r=await http.get(Uri.parse('$baseUrl/products.php'),headers:headers);if(r.statusCode!=200)throw Exception('Product API failed');return jsonDecode(r.body)['products'];}
 Future<void> createOrder(int productId)async{final r=await http.post(Uri.parse('$baseUrl/orders.php'),headers:headers,body:jsonEncode({'product_id':productId}));if(r.statusCode>=300)throw Exception(jsonDecode(r.body)['error']??'Order failed');}
}
