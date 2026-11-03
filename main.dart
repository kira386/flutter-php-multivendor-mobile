import 'package:flutter/material.dart';
import 'screens/home_page.dart';
void main()=>runApp(const MarketGoApp());
class MarketGoApp extends StatelessWidget{const MarketGoApp({super.key});@override Widget build(BuildContext context)=>MaterialApp(title:'MarketGo',debugShowCheckedModeBanner:false,theme:ThemeData(colorSchemeSeed:Colors.green,useMaterial3:true),home:const HomePage());}
