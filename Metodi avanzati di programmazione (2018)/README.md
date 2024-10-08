## Metodi avanzati di programmazione (2018): K-means project :pick:
Client-server system called 'K-Means". The server includes data mining capabilities for discovering data clusters. The client is a Java applet that allows you to take advantage of the remote discovery service and displays the knowledge (cluster) discovered.

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
