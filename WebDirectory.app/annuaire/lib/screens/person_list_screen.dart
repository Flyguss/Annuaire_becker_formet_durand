import 'package:flutter/material.dart';
import '../models/person.dart';
import '../services/api_service.dart';
import 'person_detail_screen.dart';
import 'filter_dialog.dart';
import 'search_screen.dart';

class PersonListScreen extends StatefulWidget {
  @override
  _PersonListScreenState createState() => _PersonListScreenState();
}

class _PersonListScreenState extends State<PersonListScreen> {
  late Future<List<Person>> _personsFuture;
  List<Person> _allPersons = [];
  List<Person> _filteredPersons = [];

  @override
  void initState() {
    super.initState();
    _personsFuture = ApiService.fetchPersonsApi();
  }

  void _navigateToDetail(Person person) {
    Navigator.push(
      context,
      MaterialPageRoute(builder: (context) => PersonDetailScreen(person: person)),
    );
  }

  void _filterList(String department) {
    setState(() {
      _filteredPersons = _allPersons.where((person) => person.departements.contains(department)).toList();
    });
  }

  void _clearFilter() {
    setState(() {
      _filteredPersons = _allPersons;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Person List'),
        actions: <Widget>[
          IconButton(
            icon: Icon(Icons.search),
            onPressed: () {
              showSearch(context: context, delegate: SearchScreen(_filteredPersons));
            },
          ),
          IconButton(
            icon: Icon(Icons.filter_list),
            onPressed: () {
              showDialog(
                context: context,
                builder: (BuildContext context) {
                  return FilterDialog(
                    onFilter: _filterList,
                    onClear: _clearFilter,
                  );
                  
                },
              );
            },
          ),
        ],
      ),
      body: FutureBuilder<List<Person>>(
  future: _personsFuture,
  builder: (context, snapshot) {
    if (snapshot.hasData) {
      if (_allPersons.isEmpty) { // Initialiser uniquement si _allPersons est vide
        _allPersons = snapshot.data!;
        _filteredPersons = _allPersons;
      }
      return ListView.builder(
        itemCount: _filteredPersons.length,
        itemBuilder: (context, index) {
          return ListTile(
            title: Text('${_filteredPersons[index].nom} ${_filteredPersons[index].prenom}'),
            subtitle: Text(_filteredPersons[index].departements.join(', ')),
            onTap: () => _navigateToDetail(_filteredPersons[index]),
          );
        },
      );
    } else if (snapshot.hasError) {
      return Center(child: Text('Error: ${snapshot.error}'));
    }
    return Center(child: CircularProgressIndicator());
  },
),

    );
  }
}
