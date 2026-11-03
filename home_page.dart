import 'package:flutter/material.dart';
import '../services/api_client.dart';
class HomePage extends StatefulWidget{const HomePage({super.key});@override State<HomePage> createState()=>_HomePageState();}
class _HomePageState extends State<HomePage>{final api=ApiClient();late Future<List<dynamic>> future;@override void initState(){super.initState();future=api.products();}
@override Widget build(BuildContext context)=>Scaffold(appBar:AppBar(title:const Text('MarketGo')),body:FutureBuilder<List<dynamic>>(future:future,builder:(context,s){if(s.connectionState==ConnectionState.waiting)return const Center(child:CircularProgressIndicator());if(s.hasError)return Center(child:Text('${s.error}'));final rows=s.data??[];return ListView.builder(itemCount:rows.length,itemBuilder:(context,i){final p=rows[i];return Card(child:ListTile(leading:const Icon(Icons.shopping_bag_outlined),title:Text(p['name']),subtitle:Text('${p['price']} ETB · ${p['seller_name']}'),));});}));}
}
