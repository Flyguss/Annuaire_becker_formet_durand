import 'package:flutter/material.dart';
import '../models/person.dart';
import '../screens/person_detail_screen.dart';

class SearchScreen extends SearchDelegate<Person> {
  final List<Person> persons;

  SearchScreen(this.persons);

  @override
  List<Widget> buildActions(BuildContext context) {
    return [
      IconButton(
        icon: Icon(Icons.clear),
        onPressed: () {
          query = '';
        },
      ),
    ];
  }

  @override
  Widget buildLeading(BuildContext context) {
    return IconButton(
      icon: Icon(Icons.arrow_back),
      onPressed: () {
        Navigator.pop(context);
      },
    );
  }

  @override
  Widget buildResults(BuildContext context) {
    List<Person> results = persons.where((person) {
      final fullName = '${person.nom.toLowerCase()} ${person.prenom.toLowerCase()}';
      return fullName.contains(query.toLowerCase());
    }).toList();
    return _buildSearchResults(results);
  }

  @override
  Widget buildSuggestions(BuildContext context) {
    List<Person> results = persons.where((person) {
      final fullName = '${person.nom.toLowerCase()} ${person.prenom.toLowerCase()}';
      return fullName.contains(query.toLowerCase());
    }).toList();
    return _buildSearchResults(results);
  }

  Widget _buildSearchResults(List<Person> results) {
    return ListView.builder(
      itemCount: results.length,
      itemBuilder: (context, index) {
        return ListTile(
          title: Text('${results[index].nom} ${results[index].prenom}'),
          subtitle: Text(results[index].departements.join(', ')),
          onTap: () {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => PersonDetailScreen(person: results[index])),
              
            );
          },
        );
      },
    );
  }
}
