import 'package:flutter/material.dart';

class FilterDialog extends StatelessWidget {
  final Function(String) onFilter;
  final VoidCallback onClear;

  const FilterDialog({Key? key, required this.onFilter, required this.onClear}) : super(key: key);
  

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: Text('Filter by Department'),
      content: SingleChildScrollView(
        child: ListBody(
          children: <Widget>[
            ElevatedButton(
              onPressed: () {
                onClear();
                Navigator.of(context).pop();
              },
              child: Text('Retirer le filtre'),
            ),
            ElevatedButton(
              onPressed: () {
                onFilter('Informatique'); 
                Navigator.of(context).pop();
              },
              child: Text('Informatique'),
            ),
            ElevatedButton(
              onPressed: () {
                onFilter('Ressources Humaines'); 
                Navigator.of(context).pop();
              },
              child: Text('Ressources Humaines'),
            ),
            ElevatedButton(
              onPressed: () {
                onFilter('Marketing'); 
                Navigator.of(context).pop();
              },
              child: Text('Marketing'),
            ),
            ElevatedButton(
              onPressed: () {
                onFilter('Finance'); 
                Navigator.of(context).pop();
              },
              child: Text('Finance'),
            ),
            ElevatedButton(
              onPressed: () {
                onFilter('Logistique'); 
                Navigator.of(context).pop();
              },
              child: Text('Logistique'),
            ),
            ElevatedButton(
              onPressed: () {
                onFilter('Ventes'); 
                Navigator.of(context).pop();
              },
              child: Text('Ventes'),
            ),
            ElevatedButton(
              onPressed: () {
                onFilter('Support Technique'); 
                Navigator.of(context).pop();
              },
              child: Text('Support Technique'),
            ),
            ElevatedButton(
              onPressed: () {
                onFilter('Recherche et Développement'); 
                Navigator.of(context).pop();
              },
              child: Text('Recherche et Développement'),
            ),
            ElevatedButton(
              onPressed: () {
                onFilter('	Production'); 
                Navigator.of(context).pop();
              },
              child: Text('	Production'),
            ),
            ElevatedButton(
              onPressed: () {
                onFilter('Administration'); 
                Navigator.of(context).pop();
              },
              child: Text('Administration'),
            ),
            ElevatedButton(
              onPressed: () {
                onFilter('	Direction'); 
                Navigator.of(context).pop();
              },
              child: Text('	Direction'),
            ),
          ],
        ),
      ),
    );
  }
}
