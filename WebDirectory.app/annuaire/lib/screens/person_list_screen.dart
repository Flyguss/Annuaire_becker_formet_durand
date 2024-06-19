import 'package:flutter/material.dart';
import 'package:flutter/scheduler.dart';
import '../models/person.dart';
import '../services/api_service.dart';
import 'person_detail_screen.dart';
import 'filter_dialog.dart';
import 'search_screen.dart';

enum SortOrder { ascendant, descendant }

class PersonListScreen extends StatefulWidget {
  @override
  _PersonListScreenState createState() => _PersonListScreenState();
}

class _PersonListScreenState extends State<PersonListScreen> {
  late Future<List<Person>> _personsFuture;
  List<Person> _allPersons = [];
  List<Person> _filteredPersons = [];
  SortOrder _sortOrder = SortOrder.ascendant;

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

  void _sortList() {
    setState(() {
      if (_sortOrder == SortOrder.ascendant) {
        _filteredPersons.sort((a, b) => a.nom.compareTo(b.nom));
        _sortOrder = SortOrder.descendant;
      } else {
        _filteredPersons.sort((a, b) => b.nom.compareTo(a.nom));
        _sortOrder = SortOrder.ascendant;
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Liste des Personnes'),
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
          IconButton(
            icon: Icon(Icons.sort),
            onPressed: _sortList,
          ),
        ],
      ),
      body: FutureBuilder<List<Person>>(
        future: _personsFuture,
        builder: (context, snapshot) {
          if (snapshot.hasData) {
            if (_allPersons.isEmpty) {
              _allPersons = snapshot.data!;
              _filteredPersons = _allPersons;
              // Utiliser SchedulerBinding pour différer le tri initial
              SchedulerBinding.instance.addPostFrameCallback((_) {
                setState(() {
                  _sortList();
                });
              });
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
            return Center(child: Text('Erreur : ${snapshot.error}'));
          }
          return Center(child: CircularProgressIndicator());
        },
      ),
    );
  }
}
