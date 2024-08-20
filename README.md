# My uniba projects and exercises :man_technologist:

Collection of projects and exerices completed during the bachelor's degree in computer science at University of Bari.

The codes and files are divided by course.

------------------------------------------------------------------------

## Laboratorio di informatica (2016): project in C language
### Management of a music playlist

Archives to create:
- Tracks: ARTIST, TITLE, GENRE (pop, rock, metal, latin, R&B), STARS (from 0 to 5 stars)
- Playlist

Operations:
1. Search for a song by title in the tracks archive
2. Viewing tracks for each genre
3. Creation and Viewing of playlist of 10 tracks
4. Every time a track is inserted into a playlist -> ++star
5. Viewing songs sorted by stars

------------------------------------------------------------------------

## Algoritmi e strutture dati (2018): exercises in C++ language
Realizations of the structures seen in class, and the exercises/algorithms with relative execution tests

------------------------------------------------------------------------

## Metodi avanzati di programmazione (2018): K-means project :pick:
Client-server system called 'K-Means". The server includes data mining capabilities for discovering data clusters. The client is a Java applet that allows you to take advantage of the remote discovery service and displays the knowledge (cluster) discovered.

*******************************************************************************

### Data mining

The purpose of data mining is the (semi)
automatic extraction of knowledge hidden in large
databases in order to make it available and
directly usable

Areas of application:
1. forecasting:
use of known values ​​to forecast unknown quantities (e.g. estimating the
turnover of a point of sale based on its characteristics);
2. classification:
identification of the characteristics that indicate to which group a certain
case belongs (e.g. discrimination between ordinary and fraudulent behaviors);
3. segmentation (or clustering):
identification of groups with homogeneous elements within the group and different
from group to group (e.g. identification of groups of consumers with
similar behaviors);
4. association:
identification of elements that often appear together in a given
event (e.g. products that frequently enter the same
shopping cart);
5. sequences:
identification of a chronology of associations (e.g. visit paths of a
website).  
    …

#### Clustering

Given:
  - a collection D of transactions, where each transaction is a vector of attribute-value pairs (item);  
  - an integer k;
    
The goal is:
  - partition D into k sets of transactions D1, …, Dk;
    
Such that:
  - Di (i=1,…,k) is a homogeneous segment (selection) of D.

#### Problems

1. How do I perform clustering?  
   - K-means.
    
2. How do I represent clusters?  
   - Compute and store cluster centroids.
    
3. How do I use clusters in real applications?  
   - Minimize the distance between a new transaction and the cluster representation to discover the cluster it belongs to.

#### k-means
```
Kmeans(D,k)-:clusterSet
clusterSet: set of k segments Di : each
  segment Di is a set of transactions in D
begin
1. initialize clusterSet with
initially empty segments
2. assign to each segment of clusterSet a
randomly chosen transaction from D
3. do
  for(transaction:D)
  3.1 Di = cluster(clusterSet,transaction)
  3.2 move transaction in segment Di
while (at least one transaction changes cluster)
4. return clusterSet;
end
```

------------------------------------------------------------------------

## Ingegneria del software (2017): project

Goals
- Increase, with reference to a museum structure, the number of visitors and their satisfaction as well as improving the hedonic experience.
- Extend the concept of "visit" by creating new paths of use and eliminating the infrastructures and visiting aid devices usually used in museums, such as audio guides, info points, brouchures, etc.
- Improve the hedonic experience connected to the actual visit to the museum through a low-cost multimedia audio guide, accessible via a common smartphone, interactive and updatable "on the fly" every time new finds are displayed.

Reference scenario:
- The case study represents a real need expressed by the following stakeholders:
  - Archeological Museum of Durres
  - University of Bari - Aldo Moro, as part of one of the various collaborative initiatives with the Albanian state
  - Apulian IT Production District

