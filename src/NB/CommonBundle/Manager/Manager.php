<?php

namespace NB\CommonBundle\Manager;

use Doctrine\ORM\EntityManager;
use JMS\Serializer\SerializerBuilder;
use NB\CommonBundle\Extension\EntityNameExtension;
use NB\CommonBundle\Util\Entity;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


/**
 * Created by PhpStorm.
 * User: farias
 * Date: 01/05/2017
 * Time: 9:32
 */
class Manager {
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * AbstractManager constructor.
     * @param EntityManager $entityManager
     * @param ContainerInterface $container
     * @param \Twig_Environment $twig
     */
    public function __construct(EntityManager $entityManager, ContainerInterface $container, \Twig_Environment $twig) {
        $this->entityManager = $entityManager;
        $this->container = $container;
        $this->twig = $twig;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection() {
        return $this->getEntityManager()->getConnection();
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer() {
        return $this->container;
    }

    /**
     * Gets a service.
     * @param $id string The service identifier
     * @return object mixed The associated service
     */
    public function get($id) {
        return $this->container->get($id);
    }

    public function getParameter($id) {
        return $this->container->getParameter($id);
    }

    /**
     * @param null $id
     * @param $show string Key Url para el show
     * @param $index string Key Url para el index
     * @return RedirectResponse
     */
    public function successRedirect($id = null, $show, $index) {
        $request = $this->getRequest();
        $flash = $request->getSession()->getFlashBag();
        $flash->add('success', $this->get('translator')->trans('operation.success', [], 'common'));

        return $id != null ? $this->redirectToRoute($show, array('id' => $id)) :
            $this->redirectToRoute($index);
    }

    /**
     * @param $route
     * @param array $parameters
     * @param int $status
     * @return RedirectResponse
     */
    protected function redirectToRoute($route, array $parameters = array(), $status = 302) {
        $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH;
        $url = $this->get('router')->generate($route, $parameters, $referenceType);
        return new RedirectResponse($url, $status);
    }

    /**
     * @return bool
     */
    public function isXmlHttpRequest() {
        return $this->getRequest()->isXmlHttpRequest() || $this->getRequest()->get('_xml_http_request');
    }

    /**
     * @param $data
     * @param int $status
     * @param array $headers
     * @return Response
     */
    public function renderJson($data, $status = 200, $headers = array()) {
        if ($this->getRequest()->get('_xml_http_request')
            && strpos($this->getRequest()->headers->get('Content-Type'), 'multipart/form-data') === 0
        ) {
            $headers['Content-Type'] = 'text/plain';
        } else {
            $headers['Content-Type'] = 'application/json';
        }

        return new Response(json_encode($data), $status, $headers);
    }

    /**
     * Convierte un objeto en un array asociativo
     * @param $object
     * @return array
     */
    function dismount($object) {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }

    /**
     * @return Request|null
     */
    public function getRequest() {
        return $this->get('request_stack')->getCurrentRequest();
    }

    /**
     * Serializa un objeto o array de doctrine o de cualquier tipo en un json
     * @param $data
     * @return mixed|string
     */
    public function serializeJSON($data) {
        $serializer = SerializerBuilder::create()->build();
        $raw = $serializer->serialize($data, 'json');
        return addslashes($raw); //escapando la comilla simple en el texto de la descripcion y el resumen
    }


    public function hidrateResult($entity, array $where = [], array $orderBy = []) {
        $em = $this->getEntityManager();

        $query = $em->getRepository($entity)
            ->createQueryBuilder('e')
            ->where('1 > 0');
        foreach ($where as $key => $value) {
            $query = $query->andWhere('e.' . $key . ' = :' . $key);
        }
        foreach ($orderBy as $key => $value) {
            $query = $query->orderBy('e.' . $key, $value);
        }
        foreach ($where as $key => $value) {
            $query = $query->setParameter($key, $value);
        }
        $query = $query->getQuery();
        return $query->getArrayResult();
    }

    public function getAssetPath() {
        return $this->get('nb.media.file.uploader')->getAssetPath();
    }

    /**
     * @param $entity mixed
     * @throws \Exception
     * @return string
     */
    public function getEntityName($entity) {
        if ($entity instanceof EntityNameExtension) {
            $entityName = $entity->getEntityName();
        } else {
            throw new \InvalidArgumentException('The entity must have a method called getEntityName()');
        }
        return $entityName;
    }

    /**
     * Returns a rendered view.
     *
     * @param string $view The view name
     * @param array $parameters An array of parameters to pass to the view
     *
     * @return string The rendered view
     *
     * @final since version 3.4
     */
    protected function renderView($view, array $parameters = array()) {
        if ($this->container->has('templating')) {
            return $this->container->get('templating')->render($view, $parameters);
        }
        if (!$this->container->has('twig')) {
            throw new \LogicException('You can not use the "renderView" method if the Templating Component or the Twig Bundle are not available. Try running "composer require symfony/twig-bundle".');
        }
        return $this->container->get('twig')->render($view, $parameters);
    }
}